<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #f2f2f2;
            color: #222;
            font-family: Arial, sans-serif;
        }

        .form-box {
            width: 100%;
            max-width: 440px;
            padding: 35px;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        h1 {
            margin: 0 0 8px;
            font-size: 26px;
            text-align: center;
        }

        .subtitle {
            margin: 0 0 25px;
            color: #777;
            text-align: center;
        }

        label {
            display: block;
            margin: 15px 0 7px;
            color: #333;
            font-weight: 700;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font: inherit;
        }

        input:focus {
            border-color: #6c5ce7;
            outline: 2px solid rgba(108, 92, 231, 0.16);
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
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

        .bottom-text {
            margin: 20px 0 0;
            color: #666;
            text-align: center;
        }

        a {
            color: #6c5ce7;
            font-weight: 700;
            text-decoration: none;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 7px;
            text-align: center;
        }

        .error {
            background: #ffe0e0;
            color: #c0392b;
        }

        .success {
            background: #dff7e5;
            color: #218838;
        }

        @media (max-width: 480px) {
            .form-box {
                padding: 26px 22px;
            }
        }
    </style>
</head>
<body>
    <main class="form-box">
        <h1>Create Account</h1>
        <p class="subtitle">Sign up to continue</p>

        <?php if (isset($_GET['error'])): ?>
            <div class="message error"><?= htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <div class="message success"><?= htmlspecialchars($_GET['success'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form action="signup_process.php" method="POST" enctype="multipart/form-data">
            <label for="name">Full Name</label>
            <input id="name" type="text" name="name" placeholder="Enter your name" autocomplete="name" required>

            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="Enter your email" autocomplete="email" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Enter password" autocomplete="new-password" required>

            <label for="confirm-password">Confirm Password</label>
            <input id="confirm-password" type="password" name="confirm_password" placeholder="Confirm password" autocomplete="new-password" required>

            <label for="profile-picture">Profile Picture</label>
            <input id="profile-picture" type="file" name="profile_picture" accept="image/jpeg,image/png,image/gif,image/webp" required>

            <button type="submit" name="signup">Sign Up</button>
        </form>

        <p class="bottom-text">Already have an account? <a href="login.php">Log in</a></p>
    </main>
</body>
</html>

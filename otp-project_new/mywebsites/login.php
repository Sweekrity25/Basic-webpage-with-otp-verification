<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link rel="stylesheet" href="style.css?v=2">

</head>

<body>

<div class="container">

    <div class="form-box">

        <h2>Welcome Back</h2>

        <p class="subtitle">Login to your account</p>

        <?php

        if (isset($_GET['error'])) {
            echo '<div class="error">' . htmlspecialchars($_GET['error']) . '</div>';
        }

        if (isset($_GET['success'])) {
            echo '<div class="success">' . htmlspecialchars($_GET['success']) . '</div>';
        }

        ?>

        <form action="login_process.php" method="POST">

            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Enter your password"
                required
            >
            <p class="forgot"><a href="../otp-project_new/index.php">Forgot Password ?<a></p>
            <button type="submit" name="login">
                Login
            </button>

        </form>

        <p class="bottom-text">

            <span class="account-prompt">Don't have an account?</span>

            <a href="signup.php">
                Create Account
            </a>

        </p>

    </div>

</div>
    
</body>
</html>
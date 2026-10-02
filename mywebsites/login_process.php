<?php

session_start();

require_once __DIR__ . '/../config/db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit();
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';


// Check empty fields

if ($email === '' || $password === '') {

    header("Location: login.php?error=Email and password are required");
    exit();
}


// Find user

$sql = "SELECT id, name, email, password
        FROM users
        WHERE email = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();


// Check user

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();


    // Verify hashed password

    if (password_verify($password, $user['password'])) {

        // Create session

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        session_regenerate_id(true);

        $stmt->close();

        header("Location: dashboard.php");
        exit();

    } else {

        $stmt->close();

        header("Location: login.php?error=Invalid password");
        exit();
    }

} else {

    $stmt->close();

    header("Location: login.php?error=Account not found");
    exit();
}

?>
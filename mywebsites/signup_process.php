<?php

require_once __DIR__ . '/../config/db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: signup.php");
    exit();
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';


// Check empty fields

if ($name === '' || $email === '' || $password === '' || $confirm_password === '') {
    header("Location: signup.php?error=All fields are required");
    exit();
}


// Check password

if ($password !== $confirm_password) {
    header("Location: signup.php?error=Passwords do not match");
    exit();
}


// Check password length

if (strlen($password) < 6) {
    header("Location: signup.php?error=Password must contain at least 6 characters");
    exit();
}


// Check email

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: signup.php?error=Invalid email address");
    exit();
}


// Check whether email already exists

$check = $conn->prepare("SELECT id FROM users WHERE email = ?");

$check->bind_param("s", $email);

$check->execute();

$result = $check->get_result();

if ($result->num_rows > 0) {

    $check->close();

    header("Location: signup.php?error=Email already registered");
    exit();
}

$check->close();


// Check profile picture

if (!isset($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {

    header("Location: signup.php?error=Please select a profile picture");
    exit();
}


$file = $_FILES['profile_picture'];


// Maximum file size = 5 MB

if ($file['size'] > 5 * 1024 * 1024) {

    header("Location: signup.php?error=Profile picture must be less than 5 MB");
    exit();
}


// Detect MIME type

$finfo = new finfo(FILEINFO_MIME_TYPE);

$mime_type = $finfo->file($file['tmp_name']);


// Allowed image types

$allowed_types = [
    'image/jpeg',
    'image/png',
    'image/gif',
    'image/webp',
    'image/jpg'
];


if (!in_array($mime_type, $allowed_types, true)) {

    header("Location: signup.php?error=Only JPG, PNG, GIF or WEBP images are allowed");
    exit();
}


// Read image as binary data

$image_data = file_get_contents($file['tmp_name']);


// Hash password

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


// Insert user

$sql = "INSERT INTO users
        (name, email, password, profile_picture, profile_type)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);


// "sssss" = 5 string values

$stmt->bind_param(
    "sssss",
    $name,
    $email,
    $hashed_password,
    $image_data,
    $mime_type
);


if ($stmt->execute()) {

    $stmt->close();

    header("Location: login.php?success=Account created successfully. Please login.");
    exit();

} else {

    $stmt->close();

    header("Location: signup.php?error=Something went wrong. Please try again.");
    exit();
}

?>
<?php

require_once __DIR__ . '/../config/db.php';

if (!isset($_GET['id'])) {
    http_response_code(404);
    exit("User ID not provided");
}

$id = intval($_GET['id']);

$sql = "SELECT profile_picture, profile_type
        FROM users
        WHERE id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    exit("Database query failed");
}

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    http_response_code(404);
    exit("User not found");
}

$user = $result->fetch_assoc();

if (empty($user['profile_picture'])) {
    http_response_code(404);
    exit("Profile picture not found");
}

$type = $user['profile_type'];

if (empty($type)) {
    $type = "image/jpeg";
}

header("Content-Type: " . $type);
header("Content-Length: " . strlen($user['profile_picture']));
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");

echo $user['profile_picture'];

$stmt->close();
$conn->close();

?>
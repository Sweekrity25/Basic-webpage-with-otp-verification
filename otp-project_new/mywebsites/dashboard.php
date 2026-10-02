<?php

session_start();


// Check login

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php?error=Please login first");
    exit();
}


require_once __DIR__ . '/../config/db.php';


// Get current user's ID

$user_id = $_SESSION['user_id'];


// Get user information

$sql = "SELECT id, name, email, password, profile_type, created_at
        FROM users
        WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $user_id);

$stmt->execute();

$result = $stmt->get_result();


// User not found

if ($result->num_rows !== 1) {

    session_destroy();

    header("Location: login.php?error=User account not found");
    exit();
}


$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Dashboard</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="dashboard">

    <div class="topbar">

        <h2>My Dashboard</h2>

        <a href="logout.php" class="logout">
            Logout
        </a>

    </div>


    <div class="profile-card">

        <div class="profile-image">
    <img 
        src="profile_image.php?id=<?php echo (int)$user['id']; ?>" 
        alt="Profile Picture"
    >
</div>


        <h1>
            <?php echo htmlspecialchars($user['name']); ?>
        </h1>


        <p class="email">
            <?php echo htmlspecialchars($user['email']); ?>
        </p>


        <div class="user-details">

            <div class="detail">

                <span>User ID</span>

                <strong>
                    <?php echo htmlspecialchars($user['id']); ?>
                </strong>

            </div>


            <div class="detail">

                <span>Name</span>

                <strong>
                    <?php echo htmlspecialchars($user['name']); ?>
                </strong>

            </div>


            <div class="detail">

                <span>Email</span>

                <strong>
                    <?php echo htmlspecialchars($user['email']); ?>
                </strong>

            </div>


            <div class="detail">

                <span>Account Created</span>

                <strong>
                    <?php echo htmlspecialchars($user['created_at']); ?>
                </strong>

            </div>

        </div>


        <div class="dashboard-buttons">

            <a href="logout.php" class="logout-button">
                Logout
            </a>

        </div>

    </div>

</div>

</body>

</html>
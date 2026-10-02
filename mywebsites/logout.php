<?php

session_start();


// Remove all session variables

$_SESSION = [];


// Destroy session

session_destroy();


// Go to login

header("Location: login.php?success=You have been logged out");

exit();

?>
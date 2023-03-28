<?php
include("include/config.php");
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session cookie
if (ini_get("session.use_cookies")) {
    $stmt = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $stmt["path"], $stmt["domain"],
        $stmt["secure"], $stmt["httponly"]
    );
}

session_destroy();
// Redirect to the login page:
echo "<p style='color:green; text-align:center;'>You are logged out</p>";
header('Location: login.php');
?>
<?php
include("include/config.php");
session_start();
session_destroy();
// Redirect to the login page:
echo "<p style='color:green; text-align:center;'>You are Login out</p>";
header('Location: login.php');
?>
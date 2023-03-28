<?php
session_start();
// Establish a connection to the database
$conn = mysqli_connect("localhost", "root", "", "loginapp_insecure") or die("Database Connection Failed");

echo "Database Connection Successful";
?>
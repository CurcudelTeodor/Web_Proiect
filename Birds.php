<?php
session_start();

// Check if the 'username' session variable is null or not set
if (!isset($_SESSION['username']) || $_SESSION['username'] === null) {
    header("Location: login.html"); // Redirect to the login page if not logged in
    exit();
}

// Output the contents of "home.html"
readfile("Birds.html");
?>
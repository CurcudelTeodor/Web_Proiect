<?php
session_start();

// Check if the 'username' session variable is null or not set
if ( $_SESSION['username'] === "") {
    header("Location: login.html"); // Redirect to the login page if not logged in
    exit();
}

// Output the contents of "home.html"
readfile("about.html");
?>
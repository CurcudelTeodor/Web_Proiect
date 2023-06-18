<?php
session_start();


if ( $_SESSION['username'] == "admin") {
    readfile("admin.html");
    exit();
}
else{
    header("Location: login.html"); 
    exit();
}



?>
<?php
session_start();

if (isset($_POST['logout']) && $_POST['logout'] === 'true') {

  $_SESSION['username'] = "";

}
?>

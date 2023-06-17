<?php
session_start();

if (isset($_POST['logout']) && $_POST['logout'] === 'true') {

  $_SESSION['username'] = "";

  // Optionally, you can destroy the entire session
  // session_destroy();
}
?>

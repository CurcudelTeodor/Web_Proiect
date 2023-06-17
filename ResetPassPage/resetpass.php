<?php
include("../connect.php");
class resetPass
{
    public function resetPassword($data)
    {


        $password = $_POST['new_password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $email = $_SESSION['emailRecovery'];
        echo "$password";
        if ($_SESSION['emailChanged'] == "started") {
            $query = "UPDATE useri SET password = '$hashedPassword' WHERE email = '$email'";
            $DB = new Database();
            $result = $DB->save($query);
            header("Location: ../login.html");
            $_SESSION['emailRecovery']="";
            exit;
        }

    }
}
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   $resetPass = new resetPass();
    $resetPass->resetPassword($_POST);
}

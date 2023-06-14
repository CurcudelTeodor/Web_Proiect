<?php
include("connect.php");
class Login
{

    private $error = "";

    public function verify_user($data)
    {

        $username1 = addslashes($data['username']);
        $password1 = addslashes($data['password']);
        $query = "select * from useri where username = '$username1' limit 1";

        $DB = new Database();
        $result = $DB->read($query);
        if ($result) {
            $row = $result[0];
            if (password_verify($password1, $row['password'])) {
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['username'] = $row['username'];
                header("Location: home.html");
                exit;
            } else {
                header("Location: index.html");
                exit;
            }
        } else {
            header("Location: index.html");
            exit;
        }
    }
}
session_start();
$password1 = "";
$username1 = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       $login = new Login();
      $login->verify_user($_POST);
}

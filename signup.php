<?php
include ("connect.php");
class Signup
{
    private $error = "";

    public function evaluate($data)
    {
        $email = $data['email'];
        $username = $data['username'];
        $password = $data['password'];
        foreach ($data as $key => $value) {

            if ($key == "username") {
                if (is_numeric($value)) {
                    $this->error = $this->error . "username incorect <br>";
                    header("Location: register.html");
                    exit;
                }
            }
            if ($this->is_email_used($email)) {
                $this->error = $this->error . "Email deja folosit";
                echo "Email folosit<br>";
                header("Location: register.html");
                exit;
            }
            if ($this->is_username_used($username)) {
                $this->error = $this->error . "Username deja folosit";
                echo "Username folosit<br>";
                header("Location: register.html");
                exit;
            }
        }
        if ($this->error == "") {
            $this->create_user($data);
        } else {
            echo "eroare";
            header("Location: register.html");
            exit;
            return $this->error;
        }
    }


    private function create_userid()
    {
        $length = rand(4, 19);
        $number = "";
        for ($i = 0; $i < $length; $i++) {
            $new_rand = rand(0, 9);
            $number = $number . $new_rand;
        }
        return $number;
    }


    public function create_user($data)
    {
        $username = $data['username'];
        $password = $data['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $email = $data['email'];
        $userid = $this->create_userid();

        $DB = new Database();
        $connection = $DB->connect();

        //prevenim sql injection
        $query = "INSERT INTO useri (userid, username, password, email) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $userid, $username, $hashedPassword, $email);
        mysqli_stmt_execute($stmt);

        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit;
    }

    public function is_email_used($email)
    {
        $query = "SELECT COUNT(*) as count FROM useri WHERE email = '$email'";
        $DB = new Database();
        $result = $DB->read($query);
        if ($result && isset($result[0]['count'])) {
            $count = $result[0]['count'];
            return ($count > 0);
        }
        return false;
    }


    public function is_username_used($username)
    {
        $query = "SELECT COUNT(*) as count FROM useri WHERE username = '$username'";
        $DB = new Database();
        $result = $DB->read($query);
        if ($result && isset($result[0]['count'])) {
            $count = $result[0]['count'];
            return ($count > 0);
        }
        return false;
    }
}
session_start();
$username="";
$password="";
$email="";
$confirm_password="";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    if ($password != $confirm_password) {
        header("Location: register.html");
        exit;
    } else {
        $signup = new Signup();
        $signup->evaluate($_POST);
       
    }
  
}

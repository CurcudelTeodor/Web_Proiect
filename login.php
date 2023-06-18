<?php
include("connect.php");

class Login
{
    private $error = "";

    public function verify_user($data)
    {
        $username = addslashes($data['username']);
        $password = addslashes($data['password']);

        $DB = new Database();
        $connection = $DB->connect();

        $query = "SELECT * FROM useri WHERE username = ? LIMIT 1";
        //!! ' OR 1=1; --      NOT working aynmore -> very good
        //!! ' OR 1=1; DROP TABLE useri; --     NOT working aynmore-> very good
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                if ($_SESSION['username'] == 'admin') {
                    header("Location: admin.php");
                    exit;
                }
                header("Location: home.php");
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
$password = "";
$username = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = new Login();
    $login->verify_user($_POST);
}

<?php
include ("connect.php");
class EnterYourEmail{
    public function verify_email($data){
$email = addslashes($data['email']);
$query = "select * from useri where email = '$email' limit 1";
$DB = new Database();
$result = $DB->read($query);
if ($result) {
    $row = $result[0];
    header("Location: EnterVerifCode/enterverifcode.html");
    exit;
 echo "da";
} else {
    header("Location: EnterYourEmail.html");
    exit;
}
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enter = new EnterYourEmail();
    $enter->verify_email($_POST);
}

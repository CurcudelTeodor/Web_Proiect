<?php
include ("phpEmail/email.php");
class EnterYourEmail{
    public function verify_email($data){
$email = addslashes($data['email']);
$query = "select * from useri where email = '$email' limit 1";
$DB = new Database();
$EM = new Email();
$result = $DB->read($query);
if ($result) {

    $row = $result[0];
    $_SESSION['emailRecovery'] = $email;
    
$EM->initialize($email); 
$EM->send();

        $DB->save($query);





        header("Location: EnterVerifCode/enterverifcode.html");
    exit;
 echo "da";
} else {
    header("Location: EnterYourEmail.html");
    exit;
}
    }
}

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enter = new EnterYourEmail();
    $enter->verify_email($_POST);
}

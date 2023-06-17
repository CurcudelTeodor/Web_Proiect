<?php
include("../connect.php");
class VerifCode
{
    public function verifcode($data)
    {
    
        
        $email = $_SESSION['emailRecovery'];
        $code = $data['code']; // Retrieve the code from the POST data

        // Retrieve the code from the "reset" table based on the email
        $query = "SELECT code FROM reset WHERE email = '$email'";
        $DB = new Database();
        $result = $DB->read($query);

        if ($result && isset($result[0]['code'])) {
            $storedCode = $result[0]['code'];

            // Compare the received code with the stored code
            if ($code === $storedCode) {
                $_SESSION['emailChanged']="started";
                header("Location: ../ResetPassPage/resetpass.html");
                exit;
            } else {
                header("Location: enterverifcode.html");
                exit;
            }
        } else {
            // No matching entry found in the "reset" table, handle the error or display a message
            echo "No matching entry found.";
        }
    }
}
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $verifCode = new VerifCode();
    $verifCode->verifcode($_POST);
}
?>

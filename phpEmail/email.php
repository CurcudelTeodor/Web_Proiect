<?php

include ("connect.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require 'vendor/autoload.php';
Class Email{
public $email="";
 function initialize($emailRecovery)
 {
$this->email=$emailRecovery;
}
    function generateRandomCode($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
      
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $code .= $characters[$index];
        }
      
        return $code;
    }
    public function send($em)
    {   $mail= new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;                                      
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                 
            $mail->SMTPAuth   = true;                            
            $mail->Username   = 'eneaiustingabriel@gmail.com';                
            $mail->Password   = '//You wish buddy XDD, try again next time bozo';                      
            $mail->SMTPSecure = 'tls';                             
            $mail->Port       = 587; 
         
            $mail->setFrom('eneaiustingabriel@gmail.com', 'Wild Grove');          
            $mail->addAddress($em);
            $mail->isHTML(true);  
            $randomCode = $this->generateRandomCode();    

            $DB = new Database();

            // Check if an entry with the email already exists
            $checkQuery = "SELECT * FROM reset WHERE email = '$this->email'";
            $result = $DB->read($checkQuery);
            
            if ($result && count($result) > 0) {
                // If an entry exists, update it
                $updateQuery = "UPDATE reset SET code = '$randomCode' WHERE email = '$this->email'";
                $DB->save($updateQuery);
            } else {
                // If no entry exists, insert a new row
                $insertQuery = "INSERT INTO reset (email, code) VALUES ('$this->email', '$randomCode')";
                $DB->save($insertQuery);
            }
            

            $mail->Subject = 'Codul de recuperare a contului WildGrove este:';
            $mail->Body    = "Codul este: " . $randomCode;
            $mail->AltBody = 'Cod Wild Grove';
            $mail->send();
            echo "Mail has been sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }  
    }
    
}

?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
     //Server settings
    // $mail->SMTPDebug = 4;                       //Enable verbose debug output
    // $mail->CharSet = 'UTF-8';
    // $mail->isSMTP();                            //Send using SMTP
    // $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                   //Enable SMTP authentication
    // $mail->Username   = 'meetmatesv2@gmail.com'; // email du  compte gmail
    // $mail->Password   = 'Meetmate1!';           //mdp du compte gmail
    // $mail->SMTPSecure = 'ssl';		        //Enable implicit TLS encryption
    // $mail->Port       = 465;                    //TCP port to connect to;


// devmail
    $mail->SMTPDebug = 0;           
    $mail->isSMTP();                
    $mail->Host       = 'localhost';
    $mail->SMTPAuth   = false;      
    $mail->Port       = 1025;      



    //Recipients
    $mail->setFrom('anonymous@gmail.com', 'MEETMATE');        // Addresse perçu sur l'email
    $mail->addAddress('etc@etc.etc');			        // Addresse auquel on envoit l'email
    $mail->addReplyTo('meetmatesv2@gmail.com');			// Addresse de réponse

    //Content
    $mail->isHTML(true);                //Set email format to HTML
    $mail->Subject = '<br> BLUBLU</br>'; 		// sujet de l'email
    $mail->Body    = ' <span color="red"> IM  BLUE  </span>'; 		// contenu de l'email
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>

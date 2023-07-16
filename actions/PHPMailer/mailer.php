<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Instantation and passing [CODE]true[/CODE]enable exceptions
$mail = new PHPMailer(true);

try {
//Server settings
$mail->SMTPDebug = 2;			//Enable verbose debug output
$mail->IsSMTP();			//Set mailer to use SMTP
$mail->Host = 'vps-67ee2528.vps.ovh.net';               //Adresse IP ou DNS du serveur SMTP
$mail->Port = 465;                          //Port TCP du serveur SMTP
$mail->SMTPAuth = true;                        //Utiliser l'identification

if($mail->SMTPAuth){
   $mail->SMTPSecure = 'ssl';               //Protocole de sécurisation des échanges avec le SMTP
   $mail->Username   =  'meetmatesv@gmail.com';   //Adresse email à utiliser
   $mail->Password   =  'Meetmate1!';         //Mot de passe de l'adresse email à utiliser
}

$mail->CharSet = 'UTF-8'; //Format d'encodage à utiliser pour les caractères
$mail->smtpConnect();

$mail->From       =  'vps-67ee2528.vps.ovh.net';                //L'email à afficher pour l'envoi
$mail->FromName   = 'meetmate.social';             //L'alias à afficher pour l'envoi

$mail->Subject    =  'Mon sujet';                      //Le sujet du mail
$mail->WordWrap   = 50; 			                   //Nombre de caracteres pour le retour a la ligne automatique
$mail->AltBody = 'Mon message en texte brut'; 	       //Texte brut
$mail->IsHTML(false);                                  //Préciser qu'il faut utiliser le texte brut

if($Use_HTML == true){
   $mail->MsgHTML('<div>Mon message en <code>HTML</code></div>'); 		                //Le contenu au format HTML
   $mail->IsHTML(true);
}


//AddAdress permet d'ajouter à qui remettre l'email

$list_emails_to = array('johndoe@ovh.net','maxlamenace@ovh.net');
foreach ($list_emails_to  as $key => $email) {
  $mail->AddAddress($email);
}


//Envoyer l'email 
if (!$mail->send()) {
      echo $mail->ErrorInfo;
} else{
      echo 'Message bien envoyé';
}


?>

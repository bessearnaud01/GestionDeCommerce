<?php

include_once 'vendor/autoload.php';

// Envoie d'un mail d'activation

try {
    $EMAIL_HOST ='smtp.office365.com'; 
    $EMAIL_PORT = 587;
    $EMAIL_USERNAME ='besseberenger@outlook.com';
    $EMAIL_PASSWORD ='berenger1996';
    $EMAIL_ENCRYPTION = 'tls';

    $transport = (new Swift_SmtpTransport($EMAIL_HOST, $EMAIL_PORT, $EMAIL_ENCRYPTION))
        ->setUsername($EMAIL_USERNAME)
        ->setPassword($EMAIL_PASSWORD);

        if( isset($_POST['expediteur']) && isset($_POST['titre']) && isset($_POST['message'])) {    
           
            $expediteur  = $_POST['expediteur'];
            $titre  = $_POST['titre'];
            $message = $_POST['message'];  
           

        }


    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $msg = (new Swift_Message($titre))
        ->setFrom([$expediteur =>'expediteur'])
        ->setTo([$EMAIL_USERNAME =>'besseberenger@outlook.com'])
        ->setBody($message);


    // Send the message
    $result = $mailer->send($msg);
    header('location:SendMails.php?send=1');
    
} catch(\Exception $ex) {

    die('Erreur !:'  . $ex->getMessage());
  

}

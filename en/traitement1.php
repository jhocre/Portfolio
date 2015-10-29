<?php
session_start();

// On va chercher la classe PHPMailer
require_once('../classes/class.phpmailer.php');
  



 //$errors = [];
$errors = array();
if(!array_key_exists('name', $_POST) || $_POST['name'] == '') {
  $errors ['name'] = "Your surname is missing";
  }
if(!array_key_exists('prenom', $_POST) || $_POST['prenom'] == '') {
  $errors ['prenom'] = "Your name is missing";
  }
if(!array_key_exists('sujet', $_POST) || $_POST['sujet'] == '') {
  $errors ['sujet'] = "Your subject is missing";
  }
if(!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  $errors ['email'] = "Your email is missing";
  }
if(!array_key_exists('message', $_POST) || $_POST['message'] == '') {
  $errors ['message'] = "Your message is missing";
  }


if(!empty($errors)){
  $_SESSION['errors'] = $errors;
  $_SESSION['inputs'] = $_POST;
  header('Location: ../en/index.php#_contacter');

}else{
  $_SESSION['success'] = 1;

  $message = htmlspecialchars($_POST['message']);
  $nom = (htmlspecialchars($_POST['prenom']).' '.htmlspecialchars($_POST['name']));
  $email = htmlspecialchars($_POST['email']);
  $sujet =  htmlspecialchars($_POST['sujet']);


  // Création d'un nouvel objet $mail
  $mail = new PHPMailer();
    
  // Encodage
  $mail->CharSet = 'UTF-8';
   
  // Corp de notre email
  $body = $message;
    
  // Expediteur, adresse de retour et destinataire :
  $mail->FromName = $nom;
  $mail->From = $email;
  //$mail->AddReplyTo("nicolas.verhoye@gmail.com", "Nicolas Verhoye");
  $mail->AddAddress("johanncreneguy.xyz@gmail.com", "Creneguy");
    
  // Sujet du mail
  $mail->Subject = $sujet;
    
  // Le message
  $mail->MsgHTML($body);
    
  // Pièce jointe
  $mail->AddAttachment("images/phpmailer.gif");
   
  $mail->Send();

  unset($mail);

  header('Location: ../en/index.php#_contacter');

  exit;
  
}

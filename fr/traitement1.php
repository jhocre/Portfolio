<?php
session_start();

// On va chercher la classe PHPMailer
require_once('../classes/class.phpmailer.php');
  



 //$errors = [];
$errors = array();
if(!array_key_exists('name', $_POST) || $_POST['name'] == '') {
  $errors ['name'] = "vous n'avez pas renseigné votre nom";
  }
if(!array_key_exists('prenom', $_POST) || $_POST['prenom'] == '') {
  $errors ['prenom'] = "vous n'avez pas renseigné votre prénom";
  }
if(!array_key_exists('sujet', $_POST) || $_POST['sujet'] == '') {
  $errors ['sujet'] = "vous n'avez pas renseigné votre sujet";
  }
if(!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  $errors ['email'] = "vous n'avez pas renseigné votre email";
  }
if(!array_key_exists('message', $_POST) || $_POST['message'] == '') {
  $errors ['message'] = "vous n'avez pas renseigné votre message";
  }


if(!empty($errors)){
  $_SESSION['errors'] = $errors;
  $_SESSION['inputs'] = $_POST;
  header('Location: ../fr/index.php#_contacter');

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

  header('Location: ../fr/index.php#_contacter');

  exit;
  
}

<?php
require '../../app/config/Config_Server.php';
$connexion = App::getDB();
session_start();

//recuperation de la veritable adresse ip du visiteur
function get_ip(){

  //IP si internet partagé
  if(isset($_SERVER['HTTP_CLIENT_IP'])){
    return $_SERVER['HTTP_CLIENT_IP'];
  }


  //IP derriere un proxy
  elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
    return $_SERVER['HTTP_X_FORWARDED_FOR'];
  }

  //IP normal
  else{
    return isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '';
  }
}


if(isset($_SESSION['ID_USER'])) {
  $user = intval($_SESSION['ID_USER']);
  $statut = 'utilisateur';
} else if(isset($_COOKIE['ID_USER'])) {
  $user = intval($_COOKIE['ID_USER']);
  $statut = 'utilisateur';
} else {
  $user = 0;
  $statut = 'utilisateur';
}



  if(is_numeric($_POST['identite_visitor'][0])){
    echo 'Le Nom doit commencer par une lettre';
    exit;
  }
  // Vérification de la validité des champs
  if (!preg_match('/^[A-Za-z0-9_ ]{3,16}$/', $_POST['identite_visitor'])) {
    echo "Le Nom est Invalid";
    exit();
  }


if(is_numeric($_POST['subject_visitor'][0])){
  echo 'L\'Objet doit commencer par une lettre';
  exit;
}
// Vérification de la validité des champs
if (!preg_match('/^[A-Za-z0-9_ ]{3,100}$/', $_POST['subject_visitor'])) {
  echo "Objet est Invalid";
  exit();
}

  /*-------------------------------*/
  if(is_numeric($_POST['email_visitor'][0])){
    echo 'L\'email doit commencer par une lettre<br>';
    exit;
  }
  if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['email_visitor'])) {
    echo "Email Invalid";
    exit();
  }

  /*-------------------------------*/

  /*if (!preg_match('/^[A-Za-z0-9_ ]{3,1000}$/', $_POST['message_visitor'])) {
      echo "Le Message Présente des Erreurs";
      exit();
  }*/


  if(!filter_var(get_ip(), FILTER_VALIDATE_IP)) { //Validation d'une adresse IP.
    echo 'Adresse Ip Invalid';
    exit();
  }
  /*---------------------------------------------------*/

  /* htmlentities empêche l'excution du code HTML
   * le ENT_QUOTES pour dire à htmlentities qu'on veut en plus transformer les apostrophes et guillemets*/

  $_POST['identite_visitor'] = htmlentities(strtolower(stripslashes(htmlspecialchars($_POST['identite_visitor']))), ENT_QUOTES);
  $_POST['email_visitor'] = htmlentities(strtolower(stripslashes(htmlspecialchars($_POST['email_visitor']))), ENT_QUOTES);
  $_POST['subject_visitor'] = htmlentities(strtolower(stripslashes(htmlspecialchars($_POST['subject_visitor']))), ENT_QUOTES);
  $_POST['message_visitor'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['message_visitor'])))), ENT_QUOTES);


  $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['email_visitor'].'"');

  if($nbre > 0){
    echo 'l\'adresse Email est déjà utilisé';
    exit;
  }

  else {
    extract($_POST);


      $nbr_newsletter = $connexion->rowCount('SELECT id FROM newsletters WHERE email_newsletter ="'.$_POST['email_visitor'].'"');
    if($nbr_newsletter == 0)
    {

      $connexion->insert('INSERT INTO users(last_name, email, newsletter_id, objet, message, ip, created_at) 
                                      VALUES(?, ?, ?, ?, ?, ?, ?)',
          [$_POST['identite_visitor'],
          $_POST['email_visitor'],
          0,
          $_POST['subject_visitor'],
          $_POST['message_visitor'],
          get_ip(),
          time() ]);

    }
    else{

        $newsletter = $connexion->prepare_request('SELECT id FROM newsletters WHERE email_newsletter=:email', array('email'=>$_POST['email_visitor']));

      $connexion->insert('INSERT INTO users(last_name, email, newsletter_id, objet, message, ip, created_at) 
                                      VALUES(?, ?, ?, ?, ?, ?, ?)', [$_POST['identite_visitor'],
          $_POST['email_visitor'],
          $newsletter['id'],
          $_POST['subject_visitor'],
          $_POST['message_visitor'],
          get_ip(),
          time() ]);

    }

    echo 'Opération éffectué avec succès';
  }


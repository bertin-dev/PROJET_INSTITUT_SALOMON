<?php
require '../../app/config/Config_Server.php';
$connexion = App::getDB();



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

//commentaire
if(isset($_GET['comment'])) {

    if(is_numeric($_POST['name'][0])){
        echo 'Le Nom doit commencer par une lettre';
        exit;
    }
    // Vérification de la validité des champs
    if (!preg_match('/^[A-Za-z0-9_ ]{3,16}$/', $_POST['name'])) {
        echo "Le Nom est Invalid";
        exit();
    }

    /*-------------------------------*/
    if(is_numeric($_POST['email'][0])){
        echo 'L\'email doit commencer par une lettre<br>';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['email'])) {
        echo "Email Invalid";
        exit();
    }

    /* htmlentities empêche l'excution du code HTML
     * le ENT_QUOTES pour dire à htmlentities qu'on veut en plus transformer les apostrophes et guillemets*/

    $_POST['name'] = htmlentities(strtolower(stripslashes(htmlspecialchars($_POST['name']))), ENT_QUOTES);
    $_POST['email'] = htmlentities(strtolower(stripslashes(htmlspecialchars($_POST['email']))), ENT_QUOTES);
    $_POST['comment'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['comment'])))), ENT_QUOTES);


    $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['email'].'"');

    if($nbre > 0){
        echo 'l\'adresse Email est déjà utilisé';
        exit;
    }

    else {
        extract($_POST);

        //$newsletter = $connexion->prepare_request('SELECT id_newsletter FROM newsletter WHERE email_newsletter=:email', array('email'=>$_POST['email_visitor']));



        $connexion->insert('INSERT INTO users(first_name, email, user_type, created_at) 
                                               VALUES(?, ?, ?, ?)', array($_POST['name'], $_POST['email'], 'visiteur', time()));

        //last user insert
        $max = $connexion->prepare_request('SELECT id AS max_id FROM users ORDER BY id DESC LIMIT 1', array());


        $connexion->insert('INSERT INTO comments(content, created_at, user_id, post_id) 
                                               VALUES(?, ?, ?, ?)', array($_POST['comment'], time(), $max['max_id'], $_POST['post_id']));

        echo 'success';
    }

}



//reponse aux commentaires
if(isset($_GET['reply'])) {
    //var_dump($_POST['item_name1']. '-' . $_POST['item_email1'] . '-' . $_POST['item_comment1']);
    //die();

    if(is_numeric($_POST['item_name1'][0])){
        echo 'Le Nom doit commencer par une lettre';
        exit;
    }
    // Vérification de la validité des champs
    if (!preg_match('/^[A-Za-z0-9_ ]{3,16}$/', $_POST['item_name1'])) {
        echo "Le Nom est Invalid";
        exit();
    }

    /*-------------------------------*/
    if(is_numeric($_POST['item_email1'][0])){
        echo 'L\'email doit commencer par une lettre<br>';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['item_email1'])) {
        echo "Email Invalid";
        exit();
    }

    /* htmlentities empêche l'excution du code HTML
     * le ENT_QUOTES pour dire à htmlentities qu'on veut en plus transformer les apostrophes et guillemets*/

    $_POST['item_name1'] = htmlentities(strtolower(stripslashes(htmlspecialchars($_POST['item_name1']))), ENT_QUOTES);
    $_POST['item_email1'] = htmlentities(strtolower(stripslashes(htmlspecialchars($_POST['item_email1']))), ENT_QUOTES);
    $_POST['item_comment1'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['item_comment1'])))), ENT_QUOTES);


    $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['item_name1'].'"');

    if($nbre > 0){
        echo 'l\'adresse Email est déjà utilisé';
        exit;
    }

    else {
        extract($_POST);

        //$newsletter = $connexion->prepare_request('SELECT id_newsletter FROM newsletter WHERE email_newsletter=:email', array('email'=>$_POST['email_visitor']));



        $connexion->insert('INSERT INTO users(first_name, email, user_type, created_at) 
                                               VALUES(?, ?, ?, ?)', array($_POST['item_name1'], $_POST['item_email1'], 'visiteur', time()));

        //last user insert
        $max = $connexion->prepare_request('SELECT id AS max_id FROM users ORDER BY id DESC LIMIT 1', array());


        $connexion->insert('INSERT INTO comments_reply(content, created_at, user_id, comments_id) 
                                               VALUES(?, ?, ?, ?)', array($_POST['item_comment1'], time(), $max['max_id'], $_GET['reply']));

        echo 'success';
    }

}



// Newsletters
if(isset($_GET['newsletter'])) {

    if(is_numeric($_POST['newsletter'][0])){
        echo 'L\'email doit commencer par une lettre';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['newsletter'])) {
        echo "Email Invalid";
        exit();
    }
    $_POST['newsletter'] = strtolower(stripslashes(htmlspecialchars($_POST['newsletter'])));

    $nbre = $connexion->rowCount('SELECT id FROM newsletters WHERE email_newsletter="'.$_POST['newsletter'].'"');

    if($nbre > 0){
        echo 'l\'adresse Email est déjà utilisé';
        exit;
    }

    else {

            $connexion->insert('INSERT INTO newsletters(email_newsletter, ip, created_at)
                                      VALUES(?,?,?)', [$_POST['newsletter'], get_ip(), time()]);

        echo 'success';
    }

}
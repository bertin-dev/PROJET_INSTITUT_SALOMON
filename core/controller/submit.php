<?php
require '../../app/config/Config_Server.php';
session_start();
$connexion = App::getDB();

function nettoieProtect(){

    foreach($_POST as $k => $v){
        $v=strip_tags(trim($v));
        $_POST[$k]=$v;
    }

    foreach($_GET as $k => $v){
        $v=strip_tags(trim($v));
        $_GET[$k]=$v;
    }

    foreach($_REQUEST as $k => $v){
        $v=strip_tags(trim($v));
        $_REQUEST[$k]=$v;
    }

}


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


    /*$nbre = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['email'].'"');

    if($nbre > 0){
        echo 'l\'adresse Email est déjà utilisé';
        exit;
    }

    else {*/
        extract($_POST);

        $connexion->insert('INSERT INTO users(first_name, email, user_type, created_at) 
                                               VALUES(?, ?, ?, ?)', array($_POST['name'], $_POST['email'], 'visiteur', time()));

        //last user insert
        $max = $connexion->prepare_request('SELECT id AS max_id FROM users ORDER BY id DESC LIMIT 1', array());


        $connexion->insert('INSERT INTO comments(content, created_at, user_id, post_id) 
                                               VALUES(?, ?, ?, ?)', array($_POST['comment'], time(), $max['max_id'], $_POST['post_id']));

        echo 'success';
    //}

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


    /*$nbre = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['item_name1'].'"');
    if($nbre > 0){
        echo 'l\'adresse Email est déjà utilisé';
        exit;
    }*/

    //else {
        extract($_POST);
        $connexion->insert('INSERT INTO users(first_name, email, user_type, created_at) 
                                               VALUES(?, ?, ?, ?)', array($_POST['item_name1'], $_POST['item_email1'], 'visiteur', time()));
        //last user insert
        $max = $connexion->prepare_request('SELECT id AS max_id FROM users ORDER BY id DESC LIMIT 1', array());


        $connexion->insert('INSERT INTO comments_reply(content, created_at, user_id, comments_id) 
                                               VALUES(?, ?, ?, ?)', array($_POST['item_comment1'], time(), $max['max_id'], $_GET['reply']));

        echo 'success';
    //}

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


/* ==========================================================================
LOGIN
   ========================================================================== */
if(isset($_GET['singIn'])) {

    /*-------------------------------*/
    if(is_numeric($_POST['email'][0])){
        echo 'L\'email doit commencer par une lettre';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['email'])) {
        echo "Email Invalid";
        exit();
    }

    /*---------------------------------------------------*/

    if(strlen($_POST['password']) < 4 ){
        echo "Trop court (4 caractères Minimum)";
        exit;
    }

    if (!preg_match('/^[A-Za-z0-9_-]{4,30}$/', $_POST['password'])) {
        echo "password Invalid";
        exit();
    }

    $_POST['email'] = strtolower(stripslashes(htmlspecialchars($_POST['email'])));
    $_POST['password'] = stripslashes(htmlspecialchars($_POST['password']));
    $_POST['password'] = sha1($_POST['password']);



    $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['email'].'" AND password="'.$_POST['password'].'"');

    if($nbre <= 0){
        echo 'Votre Compte n\'existe pas ou alors n\'est pas activé';
    } else {
        $nbre_con =  $connexion->prepare_request('SELECT id, first_name, last_name, email, nbre_connexion FROM users WHERE email=:email AND password=:pwd',
            ['email'=>$_POST['email'], 'pwd'=>$_POST['password']]);

        $connexion->update('UPDATE users SET last_connexion=:last_connexion, nbre_connexion=:nbre_connexion 
        WHERE email=:email AND password=:pwd', ['last_connexion'=>time(), 'nbre_connexion'=>intval($nbre_con['nbre_connexion'])+1, 'email'=>$_POST['email'], 'pwd'=>$_POST['password']]);

        //gestion du checkbox qui est sur l'authentification
        if(isset($_POST['t_and_c']) && $_POST['t_and_c']=='1')
        {
            setcookie('ID_USER', $nbre_con['id'], time() + 30*24*3600, null, null, false, true);
            setcookie('NOM_USER', $nbre_con['last_name'], time() + 30*24*3600, null, null, false, true);
            setcookie('PRENOM_USER', $nbre_con['first_name'], time() + 30*24*3600, null, null, false, true);
            setcookie('EMAIL_USER', $nbre_con['email'], time() + 30*24*3600, null, null, false, true);
        }
        else{
            $_SESSION['ID_USER'] = $nbre_con['id'];
            $_SESSION['EMAIL_USER'] = $nbre_con['email'];
            $_SESSION['NOM_USER'] = $nbre_con['last_name'];
            $_SESSION['PRENOM_USER'] = $nbre_con['first_name'];
        }
        echo 'success';
    }

}


/* ==========================================================================
SYSTEME DE RECUPERATION DU MOT DE PASSE
   ========================================================================== */
if(isset($_GET['getEmail'])){

    if(is_numeric($_POST['emailForget'][0])){
        echo 'L\'email doit commencer par une lettre';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['emailForget'])) {
        echo "Email Invalid";
        exit();
    }
    $_POST['emailForget'] = strtolower(stripslashes(htmlspecialchars($_POST['emailForget'])));

    $nbre = $connexion->rowCount('SELECT ID FROM users WHERE email="'.$_POST['emailForget'].'"');

    if($nbre <= 0){
        echo 'Votre Adresse Email n\'existe pas dans notre base de données';
        exit;
    }

    else {
        //ENVOI D un EMAIL CONTENANT LE MOT DE PASSE ET L ADRESSE EMAIL DANS LA BOITE DU CORRESPONDANT
        echo 'success';
    }
}


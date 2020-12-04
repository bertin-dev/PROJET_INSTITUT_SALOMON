<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 04/02/2019
 * Time: 09h14
 */
session_start();
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



//function
function Diff_entre_2Jours($date2, $date1){
    $diff = abs($date2 - $date1);
    $result = array();
    $tmp = $diff;

    $result['second'] = $tmp % 60; // renvoi le reste de la div

    $tmp = floor(($tmp - $result['second']) / 60);
    $result['minute'] = $tmp % 60;

    $tmp = floor(($tmp - $result['minute']) / 60);
    $result['heure'] = $tmp % 24;

    $tmp = floor(($tmp - $result['heure']) / 24);
    $result['jour'] = $tmp;

    return $result['jour'];
}

    $message='';
    $success='';
    $i=0;


// Connexion à la base de données
require '../../app/config/Config_Server.php';

/* ==========================================================================
GESTION DE L AJOUT DU LOGO, TITRE, ICÖNE
========================================================================== */

// Une fois le formulaire envoyé
if(isset($_GET['idSiteWeb']))
{

    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['titreSiteWeb']))
    {
        $i++;
        $message .= "Titre Invalid<br />\n";
    }

    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['sloganSiteWeb']))
    {
        $i++;
        $message .= "Slogan Invalid<br />\n";
    } else {



        //on verifi si l'adresse de l'image a ete bien definit
        if(isset($_FILES['logo']['name']) AND !empty($_FILES['logo']['name']))
        {
            //on verifi la taille de l'image
            if($_FILES['logo']['size']>=1000)
            {
                $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                //la fonction strtolower($chaine) renvoit la chaine en minuscule
                $extension_upload=strtolower(substr(strrchr($_FILES['logo']['name'],'.'),1));
                //on verifi si l'extension_upload est valide

                if(in_array($extension_upload,$extensions_valides))
                {
                    $token=md5(uniqid(rand(),true));
                    $logo="../../public/assets/img/home/{$token}.{$extension_upload}";
                    // $chemin="blog_img/{$token}.{$extension_upload}";
                    //on deplace du serveur au disque dur

                    if(move_uploaded_file($_FILES['logo']['tmp_name'],$logo))
                    {
                        // La photo est la source
                        if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                        {$source = imagecreatefromjpeg($logo);}
                        else{$source = imagecreatefrompng($logo);}
                        $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                        // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                        $largeur_source = imagesx($source);
                        $hauteur_source = imagesy($source);
                        $largeur_destination = imagesx($destination);
                        $hauteur_destination = imagesy($destination);
                        //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                        $icon="../../public/assets/img/home/miniature/{$token}.{$extension_upload}";
                        // On crée la miniature
                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                        imagejpeg($destination,$icon);
                    } else {
                        $message .= "no deplace<br/>";
                    }
                } else {
                    $message .= "no extensions<br/>";
                }
            } else {
                $message .= "no size<br/>";
            }
        } else {
            $message .= "no defined<br/>";
        }



        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM top_headers');

        // Si une erreur survient
        if($result > 0 ) {
            $connexion->update('UPDATE top_headers SET nom_site=:nom_site, slogan=:slogan, logo=:logo, icon=:icon, url_skype=:url_skype, url_facebook=:url_facebook, url_twitter=:url_twitter, url_linkedin=:url_linkedin, updated_at=:updated_at',
                array('nom_site'=>$_POST['titreSiteWeb'],
                    'slogan'=>$_POST['sloganSiteWeb'],
                    'logo'=>$logo,
                    'icon'=>$icon,
                    'url_skype'=>$_POST['skypeSiteWeb'],
                    'url_facebook'=>$_POST['fbSiteWeb'],
                    'url_twitter'=>$_POST['twitterSiteWeb'],
                    'url_linkedin'=>$_POST['linkedInSiteWeb'],
                    'updated_at'=>time()));
            $message .= 'success-update';
        }
        else {
            $connexion->insert('INSERT INTO top_headers(nom_site, slogan, logo, icon, url_skype, url_facebook, url_twitter, url_linkedin, created_at)
                                               VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)',
                array($_POST['titreSiteWeb'], $_POST['sloganSiteWeb'], $logo, $icon, $_POST['skypeSiteWeb'], $_POST['fbSiteWeb'], $_POST['twitterSiteWeb'], $_POST['linkedInSiteWeb'], time()));
            $message .= 'success';
        }
    }
    echo $message;
}


/* ==========================================================================
GESTION DU MENU
========================================================================== */

// Une fois le formulaire envoyé
if(isset($_GET['menu'])) {

    if(!isset($_POST['menu']) || empty($_POST['menu'])){
        $message .= "Veuillez inserer un titre<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM headers WHERE titre="'. $_POST['menu'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce Menu existe déjà';
        }
        else {

            $_POST['keyword'] = str_replace(" ", ",", $_POST['keyword']);

            $connexion->insert('INSERT INTO headers(top_headers_id, titre, description, mots_cles, image, type, url, created_at)
                                               VALUES(?, ?, ?, ?, ?, ?, ?, ?)',
                array("1", $_POST['menu'], $_POST['description_menu'], $_POST['keyword'], "", "", "", time()));


            $max = $connexion->prepare_request('SELECT id AS max_id FROM headers ORDER BY id DESC LIMIT 1', array());

            $retour = $connexion->rowCount('SELECT id FROM page');
            if($retour==0){
                $connexion->insert('INSERT INTO page(parent_id, headers_id, footer_id, created_at)
                                               VALUES(?, ?, ?, ?)',
                    array("0", $max['max_id'], "", time()));

            } else{
                $connexion->insert('INSERT INTO page(parent_id, headers_id, footer_id, created_at)
                                               VALUES(?, ?, ?, ?)',
                    array($_POST['listmenu'], $max['max_id'], "", time()));
            }


            $message .= 'success';
        }
    }
    echo $message;
}


/* ==========================================================================
GESTION DU PIED DE PAGE
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['submenu'])) {

    if(!isset($_POST['sous_menu']) || empty($_POST['sous_menu'])){
        $message .= "Veuillez inserer un titre au pied de page<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM footer WHERE titre="'. $_POST['sous_menu'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce pied de page existe déjà';
        }
        else {

            $connexion->insert('INSERT INTO footer(titre, description, url, zone, created_at)
                                               VALUES(?, ?, ?, ?, ?)',
                array($_POST['sous_menu'], $_POST['description_sous_menu'], "", $_POST['footer_b'], time()));



            $max = $connexion->prepare_request('SELECT id AS max_id FROM footer ORDER BY id DESC LIMIT 1', array());

            /*$connexion->insert('INSERT INTO page(parent_id, headers_id, footer_id, created_at)
                                               VALUES(?, ?, ?, ?)',
                array($_POST["listmenu"], $_POST["ref_menu"], $max['max_id'], time()));*/

            $connexion->update('UPDATE page SET footer_id=:footer_id, updated_at=:updated_at WHERE headers_id=:headers_id',
                array('footer_id'=>$max['max_id'],
                       'updated_at' => time(),
                        'headers_id' => $_POST["ref_menu"]));


            $message .= 'success';
        }
    }
    echo $message;
}

/* ==========================================================================
GESTION DES SLIDES
========================================================================== */

// Une fois le formulaire envoyé
if(isset($_GET['slide'])) {

    if(!isset($_POST['descSlide']) || empty($_POST['descSlide'])){
        $message .= "Veuillez inserer un titre<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM caroussel WHERE titre="'. $_POST['descSlide'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce titre existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['logo']['name']) AND !empty($_FILES['logo']['name']))
            {
                /*$file = $_FILES["files"]['tmp_name'];
                list($width, $height) = getimagesize($file);

                if($width > "180" || $height > "70") {
                    echo "Error : image size must be 180 x 70 pixels.";
                    exit;
                }*/

                //on verifi la taille de l'image
                if($_FILES['logo']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['logo']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $logo="../../public/assets/img/slide/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['logo']['tmp_name'],$logo))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($logo);}
                            else{$source = imagecreatefrompng($logo);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $icon="../../public/assets/img/home/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$icon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            $connexion->insert('INSERT INTO caroussel(titre, description, image, created_at)
                                               VALUES(?, ?, ?, ?)',
                array($_POST['titreSlide'], $_POST['descSlide'], $logo, time()));


            //$max = $connexion->prepare_request('SELECT id AS max_id FROM headers ORDER BY id DESC LIMIT 1', array());


            $message .= 'success';
        }
    }
    echo $message;
}


/* ==========================================================================
GESTION DES CATEGORIES
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['categories'])) {

    if(!isset($_POST['titre_categories']) || empty($_POST['titre_categories'])){
        $message .= "Veuillez inserer une Catégorie<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM categories WHERE title="'. $_POST['titre_categories'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Cette catégorie existe déjà';
        }
        else {

            $connexion->insert('INSERT INTO categories(title , description, created_at)
                                               VALUES(?, ?, ?)',
                array($_POST['titre_categories'], $_POST['desc_categories'], time()));


            //$max = $connexion->prepare_request('SELECT id AS max_id FROM headers ORDER BY id DESC LIMIT 1', array());


            $message .= 'success';
        }
    }
    echo $message;
}


/* ==========================================================================
UPDATE CATEGORIES
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['updateCategories'])) {

    if(!isset($_POST['titre_categories']) || empty($_POST['titre_categories'])){
        $message .= "Veuillez inserer une Catégorie<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM categories WHERE title="'. $_POST['titre_categories'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Cette catégorie existe déjà';
        }
        else {

            $connexion->update('UPDATE categories SET title=:title, description=:description, updated_at=:updated_at WHERE id=:id',
                array('title'=>$_POST['titre_categories'], 'description'=>$_POST['desc_categories'], 'updated_at'=>time(), 'id' => $_POST['category']));

            //$max = $connexion->prepare_request('SELECT id AS max_id FROM headers ORDER BY id DESC LIMIT 1', array());


            $message .= 'success';
        }
    }
    echo $message;
}


/* ==========================================================================
ADD TAGS
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['tag'])) {

    if(!isset($_POST['titre_tag']) || empty($_POST['titre_tag'])){
        $message .= "Veuillez inserer un Tag<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM tags WHERE title="'. $_POST['titre_tag'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce tag existe déjà';
        }
        else {

            $connexion->insert('INSERT INTO tags(title, created_at)
                                               VALUES(?, ?)',
                array($_POST['titre_tag'], time()));

            $message .= 'success';
        }
    }
    echo $message;
}


/* ==========================================================================
UPDATE TAGS
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['updateTag'])) {

    if(!isset($_POST['titre_tag']) || empty($_POST['titre_tag'])){
        $message .= "Veuillez inserer un Tag<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM tags WHERE title="'. $_POST['titre_tag'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce tag existe déjà';
        }
        else {

            $connexion->update('UPDATE tags SET title=:title, updated_at=:updated_at WHERE id=:id',
                array('title'=>$_POST['titre_tag'], 'updated_at'=>time(), 'id' => $_POST['tag_id']));

            $message .= 'success';
        }
    }
    echo $message;
}

/* ==========================================================================
ADD ARTICLE
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['article'])) {

    $_POST['desc_article'] = htmlspecialchars($_POST['desc_article'], ENT_QUOTES);

    if(!isset($_POST['desc_article']) || empty($_POST['desc_article'])){
        $message .= "Veuillez inserer un article<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();


            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['imgInp']['name']) AND !empty($_FILES['imgInp']['name']))
            {
                /*$file = $_FILES["files"]['tmp_name'];
                list($width, $height) = getimagesize($file);

                if($width > "180" || $height > "70") {
                    echo "Error : image size must be 180 x 70 pixels.";
                    exit;
                }*/

                //on verifi la taille de l'image
                if($_FILES['imgInp']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['imgInp']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/article/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['imgInp']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/article/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            //save posts
            $connexion->insert('INSERT INTO posts(title, content, category_id)
                                               VALUES(?, ?, ?)',
                array($_POST['titre_article'], $_POST['desc_article'], $_POST['category_id']));

            //last post selected
            $max = $connexion->prepare_request('SELECT id AS max_id FROM posts ORDER BY id DESC LIMIT 1', array());

            //save image
            $connexion->insert('INSERT INTO images(url_miniature, url, created_at, post_id)
                                               VALUES(?, ?, ?, ?)',
                array($imgArticleIcon, $imgArticle, time(), $max['max_id']));

            $message .= 'success';

    }
    echo $message;
}





/* ==========================================================================
GESTION DU MODULE
========================================================================== */
if(isset($_GET['module'])) {

    if(!isset($_POST['lbl']) || empty($_POST['lbl'])){
        $message .= "Veuillez inserer un Libellé<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM module WHERE libelle="'. $_POST['lbl'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce Module existe déjà';
        }
        else {

            $connexion->insert('INSERT INTO module(libelle, description, frequence_paiement_id, prix, duree, created_at)
                                               VALUES(?, ?, ?, ?, ?, ?)',
                array($_POST['lbl'], $_POST['desc'], $_POST['frequence'], $_POST['prix'], $_POST['duree'], time()));



            $message .= 'success';
        }
    }
    echo $message;
}

/* ==========================================================================
UPDATE MODULE
========================================================================== */
if(isset($_GET['updateM'])) {

    if(!isset($_POST['lbl']) || empty($_POST['lbl'])){
        $message .= "Veuillez inserer un Libelle<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM module WHERE libelle="'. $_POST['lbl'] .'" AND id!="'.$_POST['modID'].'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce module existe déjà';
        }
        else {

            $connexion->update('UPDATE module SET libelle=:libelle, description=:description, frequence_paiement_id=:frequence_id, prix=:prix, updated_at=:updated_at, duree=:duree WHERE id=:id',
                array('libelle'=>$_POST['lbl'], 'description'=>$_POST['desc'], 'frequence_id'=>$_POST['frequence'], 'prix'=>$_POST['prix'], 'updated_at'=>time(), 'duree'=>$_POST['duree'], 'id' => $_POST['modID']));

            $message .= 'success-update';
        }
    }
    echo $message;
}


/* ==========================================================================
DELETE MODULE
========================================================================== */
if(isset($_GET['delM'])){
    App::getDB()->delete('DELETE FROM module WHERE id=:id', ['id' =>$_GET['delM']]);
    header('Location: ../module.php?name=formation');
}



/* ==========================================================================
GESTION DES FORMATIONS
========================================================================== */

if(isset($_GET['formation'])) {

    if(!isset($_POST['lbl']) || empty($_POST['lbl'])){
        $message .= "Veuillez inserer un Libellé<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM formation WHERE headers_id="'.$_POST['header_id'].'" AND libelle="'. $_POST['lbl'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Cette formation existe déjà';
        }
        else {

            $connexion->insert('INSERT INTO formation(libelle, description, prix, etat, frequence_paiement_id, module_id, created_at, headers_id)
                                               VALUES(?, ?, ?, ?, ?, ?, ?, ?)',
                array($_POST['lbl'], $_POST['desc'], $_POST['prix'], $_POST['etat'], $_POST['frequence'], $_POST['listmodule'], time(), $_POST['header_id']));



            $message .= 'success';
        }
    }
    echo $message;
}

/* ==========================================================================
UPDATE FORMATION
========================================================================== */
if(isset($_GET['updateF'])) {

    if(!isset($_POST['lbl']) || empty($_POST['lbl'])){
        $message .= "Veuillez inserer un Libelle<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM formation WHERE headers_id="'.$_POST['header_id'].'" AND libelle="'. $_POST['lbl'] .'" AND id!="'.$_POST['formID'].'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Cette formation existe déjà';
        }
        else {

            $connexion->update('UPDATE formation SET libelle=:libelle, description=:description, frequence_paiement_id=:frequence_id, prix=:prix, etat=:etat, module_id=:module_id, updated_at=:updated_at, headers_id=:headers_id WHERE id=:id',
                array('libelle'=>$_POST['lbl'], 'description'=>$_POST['desc'], 'frequence_id'=>$_POST['frequence'], 'prix'=>$_POST['prix'], 'etat'=>$_POST['etat'], 'module_id'=>$_POST['listmodule'], 'updated_at'=>time(), 'headers_id'=>$_POST['header_id'], 'id' => $_POST['formID']));

            $message .= 'success-update';
        }
    }
    echo $message;
}


/* ==========================================================================
DELETE FORMATION
========================================================================== */
if(isset($_GET['delF'])){
    App::getDB()->delete('DELETE FROM formation WHERE id=:id', ['id' =>$_GET['delF']]);
    header('Location: ../module.php?name=formation');
}


/* ==========================================================================
ADD EQUIPE PEDAGOGIQUE
========================================================================== */
if(isset($_GET['equipeP'])) {


    if(!isset($_POST['last_name']) || empty($_POST['last_name'])){
        $message .= "Veuillez inserer votre nom<br />\n";
    } else if(!isset($_POST['first_name']) || empty($_POST['first_name'])){
        $message .= "Veuillez inserer votre prenom<br />\n";
    } else if(!isset($_POST['profession']) || empty($_POST['profession'])){
        $message .= "Veuillez inserer votre profession<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM users WHERE last_name="'. $_POST['last_name'] .'" AND first_name="'.$_POST['first_name'].'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Cette langue existe déjà';
        }
        else {

        }


        //on verifi si l'adresse de l'image a ete bien definit
        if(isset($_FILES['avatar']['name']) AND !empty($_FILES['avatar']['name']))
        {
            /*$file = $_FILES["files"]['tmp_name'];
            list($width, $height) = getimagesize($file);

            if($width > "180" || $height > "70") {
                echo "Error : image size must be 180 x 70 pixels.";
                exit;
            }*/

            //on verifi la taille de l'image
            if($_FILES['avatar']['size']>=1000)
            {
                $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                //la fonction strtolower($chaine) renvoit la chaine en minuscule
                $extension_upload=strtolower(substr(strrchr($_FILES['avatar']['name'],'.'),1));
                //on verifi si l'extension_upload est valide

                if(in_array($extension_upload,$extensions_valides))
                {
                    $token=md5(uniqid(rand(),true));
                    $imgArticle="../../public/assets/img/equipe_pedagogique/{$token}.{$extension_upload}";
                    // $chemin="blog_img/{$token}.{$extension_upload}";
                    //on deplace du serveur au disque dur

                    if(move_uploaded_file($_FILES['avatar']['tmp_name'],$imgArticle))
                    {
                        // La photo est la source
                        if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                        {$source = imagecreatefromjpeg($imgArticle);}
                        else{$source = imagecreatefrompng($imgArticle);}
                        $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                        // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                        $largeur_source = imagesx($source);
                        $hauteur_source = imagesy($source);
                        $largeur_destination = imagesx($destination);
                        $hauteur_destination = imagesy($destination);
                        //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                        $imgArticleIcon="../../public/assets/img/equipe_pedagogique/miniature/{$token}.{$extension_upload}";
                        // On crée la miniature
                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                        imagejpeg($destination,$imgArticleIcon);
                    } else {
                        $message .= "no deplace<br/>";
                    }
                } else {
                    $message .= "no extensions<br/>";
                }
            } else {
                $message .= "no size<br/>";
            }
        } else {
            $message .= "no defined<br/>";
        }

        //save users
        $connexion->insert('INSERT INTO users(first_name, last_name, profession, email, twitter, facebook, instagram, linkedin, user_type, created_at, avatar)
                                               VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array($_POST['first_name'], $_POST['last_name'], $_POST['profession'], $_POST['email'], $_POST['twitter'],
            $_POST['facebook'], $_POST['instagram'], $_POST['linkedin'], 0, time(), $imgArticle));


        $message .= 'success';

    }
    echo $message;
}

/* ==========================================================================
UPDATE EQUIPE PEDAGOGIQUE
========================================================================== */
if(isset($_GET['updateEquipP'])) {

    if(!isset($_POST['last_name']) || empty($_POST['last_name'])){
        $message .= "Veuillez inserer votre nom<br />\n";
    } else if(!isset($_POST['first_name']) || empty($_POST['first_name'])){
        $message .= "Veuillez inserer votre prenom<br />\n";
    } else if(!isset($_POST['profession']) || empty($_POST['profession'])){
        $message .= "Veuillez inserer votre profession<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM users WHERE last_name="'. $_POST['last_name'] .'" AND first_name ="'.$_POST['first_name'].'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce nom existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['avatar']['name']) AND !empty($_FILES['avatar']['name']))
            {
                /*$file = $_FILES["files"]['tmp_name'];
                list($width, $height) = getimagesize($file);

                if($width > "180" || $height > "70") {
                    echo "Error : image size must be 180 x 70 pixels.";
                    exit;
                }*/

                //on verifi la taille de l'image
                if($_FILES['avatar']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['avatar']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/equipe_pedagogique/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['avatar']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/equipe_pedagogique/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            $connexion->update('UPDATE users SET first_name=:first_name, last_name=:last_name, profession=:profession, avatar=:avatar, email=:email, twitter=:twitter, facebook=:facebook, instagram=:instagram, linkedin=:linkedin, user_type=:user_type, updated_at=:updated_at WHERE id=:id',
                array('first_name'=>$_POST['first_name'], 'last_name'=>$_POST['last_name'], 'profession'=>$_POST['profession'], 'avatar'=>$imgArticle, 'email'=>$_POST['email'], 'twitter'=>$_POST['twitter'], 'facebook'=>$_POST['facebook'], 'instagram'=>$_POST['instagram'], 'linkedin'=>$_POST['linkedin'], 'user_type'=>"0",
                    'updated_at'=>time(), 'id' => $_POST['hideID']));

            $message .= 'success-update';
        }
    }
    echo $message;
}


/* ==========================================================================
DELETE EQUIPE PEDAGOGIQUE
========================================================================== */
if(isset($_GET['delEquipP'])){
    App::getDB()->delete('DELETE FROM users WHERE id=:id', ['id' =>$_GET['delEquipP']]);
    header('Location: ../module.php?name=equipe_ped');
}




/* ==========================================================================
ADD PARTENAIRE
========================================================================== */
if(isset($_GET['partenaire'])) {


    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer le nom de votre partenaire<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM partenaires WHERE name="'. $_POST['name'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce partenaire existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['logo_partenaire']['name']) AND !empty($_FILES['logo_partenaire']['name']))
            {
                /*$file = $_FILES["files"]['tmp_name'];
                list($width, $height) = getimagesize($file);

                if($width > "180" || $height > "70") {
                    echo "Error : image size must be 180 x 70 pixels.";
                    exit;
                }*/

                //on verifi la taille de l'image
                if($_FILES['logo_partenaire']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['logo_partenaire']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/partenaire/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['logo_partenaire']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/partenaire/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            //save users
            $connexion->insert('INSERT INTO partenaires(name, img_url, created_at, updated_at, user_id)
                                               VALUES(?, ?, ?, ?, ?)',
                array($_POST['name'], $imgArticle, time(), 0, 0));


            $message .= 'success';
        }

    }
    echo $message;
}

/* ==========================================================================
UPDATE PARTENAIRE
========================================================================== */
if(isset($_GET['updatePartenaire'])) {

    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer le nom de votre partenaire<br />\n";
    }  else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM partenaires WHERE name="'. $_POST['name'] .'" AND id !="'.$_GET['updatePartenaire'].'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce partenaire existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['logo_partenaire']['name']) AND !empty($_FILES['logo_partenaire']['name']))
            {

                //on verifi la taille de l'image
                if($_FILES['logo_partenaire']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['logo_partenaire']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/partenaire/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['logo_partenaire']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/partenaire/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            $connexion->update('UPDATE partenaires SET name=:name, img_url=:img_url, user_id=:user_id, updated_at=:updated_at WHERE id=:id',
                array('name'=>$_POST['name'], 'img_url'=>$imgArticle, 'user_id'=>0,
                    'updated_at'=>time(), 'id' => $_POST['hideID']));

            $message .= 'success-update';
        }
    }
    echo $message;
}


/* ==========================================================================
DELETE PARTENAIRE
========================================================================== */
if(isset($_GET['delPartenaire'])){
    App::getDB()->delete('DELETE FROM partenaires WHERE id=:id', ['id' =>$_GET['delPartenaire']]);
    header('Location: ../module.php?name=partenaire');
}



/* ==========================================================================
ADD VIE ASSOCIATIVE
========================================================================== */
if(isset($_GET['vie_ass'])) {


    if(!isset($_POST['lbl']) || empty($_POST['lbl'])){
        $message .= "Veuillez inserer le libellé<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM vie_ass WHERE libelle="'. $_POST['lbl'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Cet élément existe déjà';
        }
        else {
            //save users
            $connexion->insert('INSERT INTO vie_ass(libelle, description, created_at)
                                               VALUES(?, ?, ?)',
                array($_POST['lbl'], $_POST['desc'], time()));


            $message .= 'success';
        }

    }
    echo $message;
}

/* ==========================================================================
UPDATE VIE ASSOCIATIVE
========================================================================== */
if(isset($_GET['updateVA'])) {

    if(!isset($_POST['lbl']) || empty($_POST['lbl'])){
        $message .= "Veuillez inserer le nom de votre partenaire<br />\n";
    }  else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM partenaires WHERE name="'. $_POST['lbl'] .'" AND id !="'.$_GET['updateVA'].'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Cette association existe déjà';
        }
        else {

            $connexion->update('UPDATE vie_ass SET libelle=:libelle, description=:description, updated_at=:updated_at WHERE id=:id',
                array('libelle'=>$_POST['lbl'], 'description'=>$_POST['desc'],
                    'updated_at'=>time(), 'id' => $_POST['hideID']));

            $message .= 'success-update';
        }
    }
    echo $message;
}


/* ==========================================================================
DELETE VIE ASSOCIATIVE
========================================================================== */
if(isset($_GET['delVA'])){
    App::getDB()->delete('DELETE FROM vie_ass WHERE id=:id', ['id' =>$_GET['delVA']]);
    header('Location: ../module.php?name=vie_ass');
}



/* ==========================================================================
ADD PHOTO ASSOCIATION
========================================================================== */
if(isset($_GET['img_vie_ass'])) {

    //on verifi si l'adresse de l'image a ete bien definit
    if(isset($_FILES['img_url']['name']) AND !empty($_FILES['img_url']['name']))
    {

        //on verifi la taille de l'image
        if($_FILES['img_url']['size']>=1000)
        {
            $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
            //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
            //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
            //la fonction strtolower($chaine) renvoit la chaine en minuscule
            $extension_upload=strtolower(substr(strrchr($_FILES['img_url']['name'],'.'),1));
            //on verifi si l'extension_upload est valide

            if(in_array($extension_upload,$extensions_valides))
            {
                $token=md5(uniqid(rand(),true));
                $imgArticle="../../public/assets/img/images/{$token}.{$extension_upload}";
                // $chemin="blog_img/{$token}.{$extension_upload}";
                //on deplace du serveur au disque dur

                if(move_uploaded_file($_FILES['img_url']['tmp_name'],$imgArticle))
                {
                    // La photo est la source
                    if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                    {$source = imagecreatefromjpeg($imgArticle);}
                    else{$source = imagecreatefrompng($imgArticle);}
                    $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                    // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                    $largeur_source = imagesx($source);
                    $hauteur_source = imagesy($source);
                    $largeur_destination = imagesx($destination);
                    $hauteur_destination = imagesy($destination);
                    //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                    $imgArticleIcon="../../public/assets/img/images/miniature/{$token}.{$extension_upload}";
                    // On crée la miniature
                    imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                    imagejpeg($destination,$imgArticleIcon);
                } else {
                    $message .= "no deplace<br/>";
                }
            } else {
                $message .= "no extensions<br/>";
            }
        } else {
            $message .= "no size<br/>";
        }
    } else {
        $message .= "no defined<br/>";
    }

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();

        //save users
        $connexion->insert('INSERT INTO images(url_miniature, url, created_at, vie_ass_id)
                                               VALUES(?, ?, ?, ?)',
            array($imgArticleIcon, $imgArticle, time(), 1));


        $message .= 'success';


    echo $message;
}

/* ==========================================================================
UPDATE PHOTO ASSOCIATION
========================================================================== */
if(isset($_GET['updateIMGva'])) {

    //on verifi si l'adresse de l'image a ete bien definit
    if(isset($_FILES['img_url']['name']) AND !empty($_FILES['img_url']['name']))
    {

        //on verifi la taille de l'image
        if($_FILES['img_url']['size']>=1000)
        {
            $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
            //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
            //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
            //la fonction strtolower($chaine) renvoit la chaine en minuscule
            $extension_upload=strtolower(substr(strrchr($_FILES['img_url']['name'],'.'),1));
            //on verifi si l'extension_upload est valide

            if(in_array($extension_upload,$extensions_valides))
            {
                $token=md5(uniqid(rand(),true));
                $imgArticle="../../public/assets/img/images/{$token}.{$extension_upload}";
                // $chemin="blog_img/{$token}.{$extension_upload}";
                //on deplace du serveur au disque dur

                if(move_uploaded_file($_FILES['img_url']['tmp_name'],$imgArticle))
                {
                    // La photo est la source
                    if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                    {$source = imagecreatefromjpeg($imgArticle);}
                    else{$source = imagecreatefrompng($imgArticle);}
                    $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                    // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                    $largeur_source = imagesx($source);
                    $hauteur_source = imagesy($source);
                    $largeur_destination = imagesx($destination);
                    $hauteur_destination = imagesy($destination);
                    //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                    $imgArticleIcon="../../public/assets/img/images/miniature/{$token}.{$extension_upload}";
                    // On crée la miniature
                    imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                    imagejpeg($destination,$imgArticleIcon);
                } else {
                    $message .= "no deplace<br/>";
                }
            } else {
                $message .= "no extensions<br/>";
            }
        } else {
            $message .= "no size<br/>";
        }
    } else {
        $message .= "no defined<br/>";
    }
        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM images WHERE url="'. $imgArticle .'" AND id !="'.$_GET['updateIMGva'].'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Cette image existe déjà';
        }
        else {

            $connexion->update('UPDATE images SET url=:url, url_miniature=:url_miniature, updated_at=:updated_at WHERE id=:id',
                array('url'=>$imgArticle, 'url_miniature'=>$imgArticleIcon,
                    'updated_at'=>time(), 'id' => $_POST['hideID']));

            $message .= 'success-update';
        }

    echo $message;
}


/* ==========================================================================
DELETE PHOTO ASSOCIATION
========================================================================== */
if(isset($_GET['delIMGva'])){
    App::getDB()->delete('DELETE FROM images WHERE id=:id', ['id' =>$_GET['delIMGva']]);
    header('Location: ../module.php?name=vie_ass');
}



/* ==========================================================================
ADD COURS DE LANGUES
========================================================================== */
if(isset($_GET['langue'])) {


    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer le nom du cours<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM langues WHERE libelle="'. $_POST['name'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Cette langue existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['img_url']['name']) AND !empty($_FILES['img_url']['name']))
            {
                /*$file = $_FILES["img_url"]['tmp_name'];
                list($width, $height) = getimagesize($file);

                if($width > "1280" || $height > "700") {
                    echo $message .=  "Error : image size must be 1280 x 700 pixels.";
                    exit();
                }*/

                //on verifi la taille de l'image
                if($_FILES['img_url']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['img_url']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/langue/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['img_url']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/langue/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            //save users
            $connexion->insert('INSERT INTO langues(libelle, description, img_url, user_id, created_at)
                                               VALUES(?, ?, ?, ?, ?)',
                array($_POST['name'], $_POST['desc'], $imgArticle, 0, time()));


            $message .= 'success';
        }

    }
    echo $message;
}

/* ==========================================================================
UPDATE COURS DE LANGUES
========================================================================== */
if(isset($_GET['updateLangue'])) {

    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer le cours de langue<br />\n";
    }  else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM langues WHERE libelle="'. $_POST['name'] .'" AND id !="'.$_GET['updateLangue'].'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce cours existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['img_url']['name']) AND !empty($_FILES['img_url']['name']))
            {

                //on verifi la taille de l'image
                if($_FILES['img_url']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['img_url']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/langue/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['img_url']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/langue/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            $connexion->update('UPDATE langues SET libelle=:libelle, description=:description, img_url=:img_url, user_id=:user_id, updated_at=:updated_at WHERE id=:id',
                array('libelle'=>$_POST['name'], 'description'=>$_POST['desc'], 'img_url'=>$imgArticle, 'user_id'=>0,
                    'updated_at'=>time(), 'id' => $_POST['hideID']));

            $message .= 'success-update';
        }
    }
    echo $message;
}


/* ==========================================================================
DELETE COURS DE LANGUES
========================================================================== */
if(isset($_GET['delLangue'])){
    App::getDB()->delete('DELETE FROM langues WHERE id=:id', ['id' =>$_GET['delLangue']]);
    header('Location: ../module.php?name=langue');
}



/* ==========================================================================
ADD VAE
========================================================================== */
if(isset($_GET['vae'])) {


    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer le libelle<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM vae WHERE libelle="'. $_POST['name'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce libelle existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['img_url']['name']) AND !empty($_FILES['img_url']['name']))
            {
                /*$file = $_FILES["img_url"]['tmp_name'];
                list($width, $height) = getimagesize($file);

                if($width > "1280" || $height > "700") {
                    echo $message .=  "Error : image size must be 1280 x 700 pixels.";
                    exit();
                }*/

                //on verifi la taille de l'image
                if($_FILES['img_url']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['img_url']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/vae/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['img_url']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/vae/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            //save users
            $connexion->insert('INSERT INTO vae(libelle, description, img_url, user_id, created_at)
                                               VALUES(?, ?, ?, ?, ?)',
                array($_POST['name'], $_POST['desc'], $imgArticle, 0, time()));


            $message .= 'success';
        }

    }
    echo $message;
}

/* ==========================================================================
UPDATE VAE
========================================================================== */
if(isset($_GET['updateVAE'])) {

    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer le cours de langue<br />\n";
    }  else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM vae WHERE libelle="'. $_POST['name'] .'" AND description !="'.$_POST['desc'].'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce libelle ou cette description existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['img_url']['name']) AND !empty($_FILES['img_url']['name']))
            {

                //on verifi la taille de l'image
                if($_FILES['img_url']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['img_url']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/vae/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['img_url']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/vae/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            $connexion->update('UPDATE vae SET libelle=:libelle, description=:description, img_url=:img_url, user_id=:user_id, updated_at=:updated_at WHERE id=:id',
                array('libelle'=>$_POST['name'], 'description'=>$_POST['desc'], 'img_url'=>$imgArticle, 'user_id'=>0,
                    'updated_at'=>time(), 'id' => $_POST['hideID']));

            $message .= 'success-update';
        }
    }
    echo $message;
}


/* ==========================================================================
DELETE VAE
========================================================================== */
if(isset($_GET['delVAE'])){
    App::getDB()->delete('DELETE FROM vae WHERE id=:id', ['id' =>$_GET['delVAE']]);
    header('Location: ../module.php?name=vae');
}



/* ==========================================================================
ADD PAJ
========================================================================== */
if(isset($_GET['paj'])) {


    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer le libelle<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM paj WHERE libelle="'. $_POST['name'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce libelle existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['img_url']['name']) AND !empty($_FILES['img_url']['name']))
            {
                /*$file = $_FILES["img_url"]['tmp_name'];
                list($width, $height) = getimagesize($file);

                if($width > "1280" || $height > "700") {
                    echo $message .=  "Error : image size must be 1280 x 700 pixels.";
                    exit();
                }*/

                //on verifi la taille de l'image
                if($_FILES['img_url']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['img_url']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/paj/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['img_url']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/paj/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            //UPLOAD FILE

            //save users
            $connexion->insert('INSERT INTO paj(libelle, description, img_url, fichier, user_id, created_at)
                                               VALUES(?, ?, ?, ?, ?, ?)',
                array($_POST['name'], $_POST['desc'], $imgArticle, '', 0, time()));


            $message .= 'success';
        }

    }
    echo $message;
}

/* ==========================================================================
UPDATE PAJ
========================================================================== */
if(isset($_GET['updatePAJ'])) {

    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer le cours de langue<br />\n";
    }  else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM vae WHERE libelle="'. $_POST['name'] .'" AND description !="'.$_POST['desc'].'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce libelle ou cette description existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['img_url']['name']) AND !empty($_FILES['img_url']['name']))
            {

                //on verifi la taille de l'image
                if($_FILES['img_url']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['img_url']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/paj/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['img_url']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/paj/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            $connexion->update('UPDATE paj SET libelle=:libelle, description=:description, img_url=:img_url, fichier=:fichier, user_id=:user_id, updated_at=:updated_at WHERE id=:id',
                array('libelle'=>$_POST['name'], 'description'=>$_POST['desc'], 'img_url'=>$imgArticle, 'fichier'=>'', 'user_id'=>0,
                    'updated_at'=>time(), 'id' => $_POST['hideID']));

            $message .= 'success-update';
        }
    }
    echo $message;
}


/* ==========================================================================
DELETE PAJ
========================================================================== */
if(isset($_GET['delPAJ'])){
    App::getDB()->delete('DELETE FROM paj WHERE id=:id', ['id' =>$_GET['delPAJ']]);
    header('Location: ../module.php?name=paj');
}








/* ==========================================================================
ADD ELEMENT A FOURNIR VAE
========================================================================== */
if(isset($_GET['vaeitem'])) {


    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer le libelle<br />\n";
    } else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM vae WHERE vae_etat="1" AND libelle="'. $_POST['name'] .'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce libelle existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['img_url']['name']) AND !empty($_FILES['img_url']['name']))
            {
                /*$file = $_FILES["img_url"]['tmp_name'];
                list($width, $height) = getimagesize($file);

                if($width > "1280" || $height > "700") {
                    echo $message .=  "Error : image size must be 1280 x 700 pixels.";
                    exit();
                }*/

                //on verifi la taille de l'image
                if($_FILES['img_url']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['img_url']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/vae/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['img_url']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/vae/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            //save users
            $connexion->insert('INSERT INTO vae(libelle, description, img_url, user_id, created_at, vae_etat)
                                               VALUES(?, ?, ?, ?, ?, ?)',
                array($_POST['name'], $_POST['desc'], $imgArticle, 0, time(), '1'));


            $message .= 'success';
        }

    }
    echo $message;
}

/* ==========================================================================
UPDATE ELEMENT A FOURNIR VAE
========================================================================== */
if(isset($_GET['updateVAEItem'])) {

    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer le cours de langue<br />\n";
    }  else {

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id FROM vae WHERE vae_etat="1" AND libelle="'. $_POST['name'] .'" AND description !="'.$_POST['desc'].'"');

        // Si une erreur survient
        if($result > 0 ) {
            $message .= 'Ce libelle ou cette description existe déjà';
        }
        else {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['img_url']['name']) AND !empty($_FILES['img_url']['name']))
            {

                //on verifi la taille de l'image
                if($_FILES['img_url']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['img_url']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $imgArticle="../../public/assets/img/vae/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['img_url']['tmp_name'],$imgArticle))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($imgArticle);}
                            else{$source = imagecreatefrompng($imgArticle);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $imgArticleIcon="../../public/assets/img/vae/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$imgArticleIcon);
                        } else {
                            $message .= "no deplace<br/>";
                        }
                    } else {
                        $message .= "no extensions<br/>";
                    }
                } else {
                    $message .= "no size<br/>";
                }
            } else {
                $message .= "no defined<br/>";
            }

            $connexion->update('UPDATE vae SET libelle=:libelle, description=:description, img_url=:img_url, user_id=:user_id, updated_at=:updated_at, vae_etat=:vae_etat WHERE id=:id',
                array('libelle'=>$_POST['name'], 'description'=>$_POST['desc'], 'img_url'=>$imgArticle, 'vae_etat'=>'1', 'user_id'=>0,
                    'updated_at'=>time(), 'id' => $_POST['hideID']));

            $message .= 'success-update';
        }
    }
    echo $message;
}


/* ==========================================================================
DELETE ELEMENT A FOURNIR VAE
========================================================================== */
if(isset($_GET['delVAEItem'])){
    App::getDB()->delete('DELETE FROM vae WHERE id=:id', ['id' =>$_GET['delVAEItem']]);
    header('Location: ../module.php?name=vae');
}




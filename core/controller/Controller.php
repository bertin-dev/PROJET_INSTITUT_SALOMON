<?php


namespace core\Controller;
// Inclus le fichier contenant les fonctions personalisées

use \app;

class Controller
{


    public function extract_DB(){

        //require '../App/Autoloader.php';
        //App\Autoloader::register();
        require '../app/config/Config_Server.php';


        // Extrait les informations correspondantes à la page en cours de la DB
        foreach(App::getDB()->query('SELECT headers.id AS id_home, parent_id, headers_id, footer_id, top_headers_id, 
         headers.titre, headers.mots_cles, headers.description, headers.image, headers.type, headers.url,
         top_headers.nom_site, top_headers.slogan, top_headers.logo, top_headers.icon, top_headers.phone, top_headers.email, top_headers.lang, top_headers.localisation,
         top_headers.url_skype, top_headers.url_facebook, top_headers.url_twitter, top_headers.url_linkedin
         FROM page
         INNER JOIN headers
         ON page.headers_id=headers.id
         INNER JOIN top_headers
         ON headers.top_headers_id=top_headers.id
         WHERE page.id='.$_ENV['id_page']) as $con):
            $_ENV['parent_id'] = $con->parent_id;
            $_ENV['id_home'] = $con->id_home;
            $_ENV['localisation'] = $con->localisation;
            $_ENV['titre'] = $con->titre;
            $_ENV['mots_cles'] = $con->mots_cles;
            $_ENV['description'] =$con->description;
            $_ENV['image'] = $con->image;
            $_ENV['type'] = $con->type;
            $_ENV['url'] = $con->url;
            $_ENV['nom_site'] = $con->nom_site;
            $_ENV['slogan'] = $con->slogan;
            $_ENV['logo'] = $con->logo;
            $_ENV['icon'] = $con->icon;
            $_ENV['phone'] = $con->phone;
            $_ENV['email'] = $con->email;
            $_ENV['lang'] = $con->lang;
            $_ENV['url_skype'] = $con->url_skype;
            $_ENV['url_facebook'] = $con->url_facebook;
            $_ENV['url_twitter'] = $con->url_twitter;
            $_ENV['url_linkedin'] = $con->url_linkedin;
        endforeach;
    }



    // Affiche les menus.
    public static function affiche_menu($idpage) {

        $connexion = \App::getDB();
        // Sélectionne toutes les pages filles de la page en cours
        // Si la page n'a pas de page fille, alors on modifie la requète pour obtenir ses pages soeurs.
        $resultat = $connexion->rowCount('SELECT * FROM `page` WHERE parent_id='.$idpage, get_called_class());

        if($resultat == 0) {
            $retour = $connexion->query('SELECT page.id AS id, titre FROM page
            INNER JOIN headers
            ON page.headers_id=headers.id
            WHERE parent_id=' . $_ENV['id_parent'], get_called_class());
        }
        else{

            $menu_retour = '<nav class="nav-menu d-none d-lg-block">';
            $menu_retour .= '<ul>';

            $menu_retour .= '<li class=""><a href="index.php" title="Accueil">Accueil</a></li>';


            foreach($connexion->query('SELECT page.id AS id, headers.id AS myHeaders, titre, description, parent_id FROM page
            INNER JOIN headers
            ON page.headers_id=headers.id
            WHERE parent_id=' . $idpage, get_called_class()) as $retour):

                $menu_retour .= '<li class=""><a href="index.php?id_page='.$retour->id.'" title="'.$retour->description.'">'.$retour->titre.'</a></li>';


            endforeach;

            $menu_retour .= '</u>';
            $menu_retour .= '</nav>';
        }
        return $menu_retour;
    }


}
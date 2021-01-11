<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 05/08/2018
 * Time: 08h52
 */

session_start();
require 'vendor/autoload.php';



define('MIN_CHARACTER', 0);
define('MAX_CHARACTER', 500);

/*<?php setcookie('pseudo', 'M@teo21', time() + 365*24*3600, null, null, false, true); ?>*/
//page de demarrage
isset($_GET['id_page']) ? $page = $_GET['id_page'] : $page=1;
$_ENV['id_page'] = $page;

//mise en cache du oorps de toutes les pages du site
ob_start("ob_gzhandler");

switch($page){
    case 1:
        require 'home.php';
        break;

    case 2:
        require 'apropos.php';
        break;

    case 3:
        require 'programmes.php';
        break;

    case 5:
        require 'paj.php';
        break;

    case 6:
        require 'va.php';
        break;

    case 8:
        require 'blog.php';
        break;

    case 10:
        require 'contact.php';
        break;


    case 11:
        require 'vae.php';
        break;

    case 12:
        require 'langues.php';
        break;

    default:
        require '404.php';

    /*case 9:
        require '../Pages/Service.php';
        break;

    case 10:
        require '../Pages/Services/Apps_mobile.php';
        break;

    case 11:
        require '../Pages/Services/Apps_web.php';
        break;

    case 12:
        require '../Pages/Services/Apps_windows.php';
        break;

    default:
        require '../Pages/404.php';*/
}

$contenu = ob_get_clean();

require 'template/default.php';




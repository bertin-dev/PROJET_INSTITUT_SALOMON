<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 28/11/2018
 * Time: 18h29
 */

require '../core/controller/Controller.php';
use core\controller\Controller;

// Active tous les warning. Utile en phase de développement. En phase de production, remplacer E_ALL par 0
error_reporting(E_ALL);

// Définit l'Id de la page d'accueil (1 dans cet exemple)
$id_page_accueil = 1;
// Récupère l'id de la page courante passée par l'URL. Si non défini, on considère que la page est la page d'accueil
isset($_GET['id_page'])? $_ENV['id_page'] = intval($_GET['id_page']) : $_ENV['id_page'] = $id_page_accueil;
$info_DB = new Controller(); $info_DB->extract_DB();

echo "<section id='' class='info-header'>
    <div class='container'>
        <div class='row bordure'>
           <div class='col-lg-1 col-4 col-sm-3 col-md-2'><span>Information:</span></div>
           <div class='col-lg-11 col-8 col-sm-9 col-md-10'>
            <div class='marquee'>
                <div class='marquee-text'>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci aliquid animi dolor, doloremque doloribus eveniet ex fuga id iste, nihil nisi nostrum odit perspiciatis quam sint soluta velit.
                </div>
            </div>
            </div>
        </div>
    </div>
</section>";


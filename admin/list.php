<?php
require '../app/config/Config_Server.php';
session_start();

if(isset($_SESSION['ID_USER'])) {
    $user_id = intval($_SESSION['ID_USER']);
    $last_name = $_SESSION['NOM_USER'];
    $first_name = $_SESSION['PRENOM_USER'];
}
else if(isset($_COOKIE['ID_USER'])) {
    var_dump($_COOKIE['NOM_USER']);
    $user_id = intval($_COOKIE['ID_USER']);
    $last_name = $_COOKIE['NOM_USER'];
    $first_name = $_COOKIE['PRENOM_USER'];
}
else {
    $user_id = 0;
    $last_name = "";
    $first_name = "";
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Institut Salomon, IS, formation, centre de formation agréé, minfop, certification, vae, paj, va">
    <meta name="author" content="Bertin Mounok, Bertin-Mounok, Pipo Ndemba, Supers-Pipo, bertin.dev, bertin-dev, Ngando Mounok Hugues Bertin">
    <meta name="copyright" content="© <?=date('Y', time());?>, bertin.dev, Inc.">

    <title>Tableau de Bord - INSTITUT SALOMON</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php require 'sidebar.php';?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php require 'topbar.php';?>
            <!-- End of Topbar -->

            <div class="container-fluid">
                <?php
                if($_GET['id'] == '1'){
                    ?>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Border Left Utilities -->
                        <div class="col-lg-6">
                            <div id="rapportSupp" class="alert alert-danger" style="display:none;"></div>
                            <?php
                            if(isset($_GET['updateMsg'])){
                                foreach (App::getDB()->query('SELECT * FROM message WHERE id='.$_GET['updateMsg']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier Message</h1>
                                    <div id="rapportMsg" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_msg" role="form"
                                          action="controllers/traitement.php?updateMsg=update" method="post">
                                        <input type="hidden" name="modID" value="<?=$mod->id;?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="lbl" id="lbl" maxlength="15"
                                                   aria-describedby="lbl" placeholder="Libelle*" value="<?=$mod->objet;?>">
                                        </div>

                                        <div class="form-group">
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description">
                                            <?=$mod->msg;?>
                                        </textarea>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                                   value="Modifier"/>
                                            <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
                                        </div>

                                    </form>
                                <?php
                                endforeach;
                            } else{
                                $result = App::getDB()->rowCount('SELECT id FROM message');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '<h1 class="h3 mb-1 text-gray-800">Ajout des Message</h1>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste de Messages est vide</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste des Messages</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_module" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>Description</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>Description</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM message
                                                                                   ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Libelle">'.$mod->objet.'</td> 
                                                <td title="Description">'.$mod->msg.'</td>
                                                <td title="Modifier"><a href="list.php?id=1&updateMsg='.$mod->id.'">Modifier</a></td>
                                                <td title="Supprimer"><a href="list.php?id=1&delMsg='.$mod->id.'" onclick="deleteMsg('.$mod->id.'); return false;">Supprimer</a></td>
                                            </tr>';
                                                    endforeach;
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <script>
                            function deleteMsg(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer ce message?")){
                                    console.log('suppression effectué avec succès');

                                    var cat = document.getElementById('rapportMsg');
                                    cat.classList.remove('alert-danger');
                                    cat.classList.add('alert-success');
                                    cat.innerHTML += 'Le module a été supprimé avec succès';
                                    cat.style.display = 'block';

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delMsg="+ element);
                                    }, 3000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }

                            function deleteTSW(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer cette element?")){
                                    console.log('suppression effectué avec succès');


                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delTSW="+ element);
                                    }, 3000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }


                            function deleteS(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer cette element?")){
                                    console.log('suppression effectué avec succès');


                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delS="+ element);
                                    }, 3000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }

                        </script>
                        <!-- Border Bottom Utilities -->
                        <div class="col-lg-6">
                            <div id="rapportTSW" class="alert alert-danger" style="display:none;"></div>
                            <?php
                            if(isset($_GET['updateTSW'])){
                                foreach (App::getDB()->query('SELECT * FROM top_headers WHERE id='.$_GET['updateTSW']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier une Info du site</h1>
                                    <div id="rapportTSW2" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_TSW" role="form"
                                          action="controllers/traitement.php?updateTSW=update" method="post">
                                        <input type="hidden" name="modID" value="<?=$mod->id;?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="titreSiteWeb"
                                                   id="titreSiteWeb" aria-describedby="titreSiteWeb" value="<?=$mod->nom_site;?>"
                                                   placeholder="Titre du site">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="sloganSiteWeb"
                                                   name="sloganSiteWeb" aria-describedby="sloganSiteWeb" value="<?=$mod->slogan;?>"
                                                   placeholder="Slogan du site">
                                        </div>

                                        <div class="form-group">
                                            <input type="url" class="form-control" id="fbSiteWeb" name="fbSiteWeb"
                                                   aria-describedby="fbSiteWeb" value="<?=$mod->url_facebook;?>"
                                                   placeholder="Url Facebook">
                                        </div>

                                        <div class="form-group">
                                            <input type="url" class="form-control" id="twitterSiteWeb"
                                                    name="twitterSiteWeb" value="<?=$mod->url_twitter;?>"
                                                   aria-describedby="twitterSiteWeb" placeholder="Url Twitter">
                                        </div>

                                        <div class="form-group">
                                            <input type="url" class="form-control" id="linkedInSiteWeb"
                                                   value="<?=$mod->url_linkedin;?>" name="linkedInSiteWeb"
                                                   aria-describedby="linkedInSiteWeb" placeholder="Url LinkedIn">
                                        </div>

                                        <div class="form-group">
                                            <input type="url" class="form-control" id="skypeSiteWeb"
                                                   value="<?=$mod->url_skype;?>" name="skypeSiteWeb"
                                                   aria-describedby="skypeSiteWeb" placeholder="Url Skype">
                                        </div>

                                        <div class="form-group">
                                            <label for="logo">Logo et Icône du site</label>
                                            <input type="file" class="form-control-file" id="logo" name="logo">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                                   value="Ajouter"/>
                                            <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
                                        </div>

                                    </form>
                                <?php
                                endforeach;
                            } else{
                                $result = App::getDB()->rowCount('SELECT top_headers.id FROM top_headers');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste d\'élements est vide</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste des informations du site</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_formation" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Titre</th>
                                                        <th>slogan</th>
                                                        <th>logo</th>
                                                        <th>url_skype</th>
                                                        <th>url_facebook</th>
                                                        <th>url_twitter</th>
                                                        <th>url_linkedin</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Titre</th>
                                                        <th>slogan</th>
                                                        <th>logo</th>
                                                        <th>url_skype</th>
                                                        <th>url_facebook</th>
                                                        <th>url_twitter</th>
                                                        <th>url_linkedin</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>

                                                    <?php
                                                    foreach (App::getDB()->query('SELECT top_headers.id AS tph_id, top_headers.nom_site, top_headers.slogan, top_headers.logo, top_headers.url_skype, top_headers.url_facebook, top_headers.url_twitter, top_headers.url_linkedin, top_headers.created_at, top_headers.updated_at 
                                                                                                   FROM top_headers
                                                                                                   ORDER BY tph_id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->tph_id.'</td>
                                                <td title="Titre">'.$mod->nom_site.'</td> 
                                                <td title="slogan">'.$mod->slogan.'</td>
                                                <td title="logo"><img class="img-fluid" src="'.str_replace('../../public', '../public/', $mod->logo).'" alt=""></td>
                                                <td title="url_skype">'.$mod->url_skype.'</td>
                                                <td title="url_facebook">'.$mod->url_facebook.'</td>
                                                <td title="url_twitter">'.$mod->url_twitter.'</td>
                                                <td title="url_linkedin">'.$mod->url_linkedin.'</td>
                                                <td title="Modifier"><a href="list.php?id=1&updateTSW='.$mod->tph_id.'">Modifier</a></td>
                                                <td title="Supprimer"><a href="list.php?id=1&delTSW='.$mod->tph_id.'" onclick="deleteTSW('.$mod->tph_id.'); return false;">Supprimer</a></td>
                                            </tr>';
                                                    endforeach;
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <div class="col-lg-12">
                            <?php
                            if(isset($_GET['updateS'])){
                                foreach (App::getDB()->query('SELECT * FROM caroussel WHERE id='.$_GET['updateS']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier une Info du site</h1>
                                    <div id="rapportS" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_S" role="form"
                                          action="controllers/traitement.php?updateS=update" method="post">
                                        <input type="hidden" name="modID" value="<?=$mod->id;?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="titre"
                                                   id="titre" aria-describedby="titre" value="<?=$mod->titre;?>"
                                                   placeholder="Titre du slide">
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control" id="desc" id="" cols="30" rows="10" name="desc" aria-describedby="desc" placeholder="description du slide"><?=$mod->description;?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="logo">Image 1024*768</label>
                                            <input type="file" class="form-control-file" id="logo" name="logo">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                                   value="Ajouter"/>
                                            <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
                                        </div>

                                    </form>
                                <?php
                                endforeach;
                            } else{
                                $result = App::getDB()->rowCount('SELECT id FROM caroussel');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste de slides est vide</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste des slides du site</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_formation" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Titre</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Titre</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>

                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM caroussel
                                                                                                   ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Titre">'.$mod->titre.'</td> 
                                                <td title="Description">'.$mod->description.'</td>
                                                <td title="logo"><img class="img-fluid" src="'.str_replace('../../public', '../public/', $mod->image).'" alt=""></td>
                                                <td title="Modifier"><a href="list.php?id=1&updateS='.$mod->id.'">Modifier</a></td>
                                                <td title="Supprimer"><a href="list.php?id=1&delS='.$mod->id.'" onclick="deleteS('.$mod->id.'); return false;">Supprimer</a></td>
                                            </tr>';
                                                    endforeach;
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                    </div>
                    <?php
                }
                elseif ($_GET['id'] == '2'){
                    ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        if(isset($_GET['updateFt'])){
                            foreach (App::getDB()->query('SELECT * FROM footer WHERE id='.$_GET['updateFt']) AS $mod):
                                ?>
                                <h1 class="h3 mb-1 text-gray-800">Modifier Footer</h1>
                                <div id="rapportFt" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_Ft" role="form"
                                      action="controllers/traitement.php?updateFt=update" method="post">
                                    <input type="hidden" name="modID" value="<?=$mod->id;?>">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="tel"
                                               id="tel" aria-describedby="tel" value="<?=$mod->phone;?>"
                                               placeholder="Telephone">
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" id="localisation" id="" cols="30" rows="10" name="localisation" aria-describedby="localisation" placeholder="localisation"><?=$mod->localisation;?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="url" class="form-control" name="url"
                                               id="url" aria-describedby="url" value="<?=$mod->web_site;?>"
                                               placeholder="Site web">
                                    </div>


                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email"
                                               id="email" aria-describedby="email" value="<?=$mod->email;?>"
                                               placeholder="Email">
                                    </div>

                                    <div class="form-group">
                                        <input type="time" class="form-control" name="heure_o"
                                               id="heure_o" aria-describedby="heure_o" value="<?=$mod->h_ouverture;?>"
                                               placeholder="Heure d'ouverture">
                                    </div>

                                    <div class="form-group">
                                        <input type="time" class="form-control" name="heure_f"
                                               id="heure_f" aria-describedby="heure_f" value="<?=$mod->h_fermeture;?>"
                                               placeholder="Heure fermeture">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
                                    </div>

                                </form>
                            <?php
                            endforeach;
                        } else{
                            $result = App::getDB()->rowCount('SELECT id FROM footer');

                            // Si une erreur survient
                            if($result == 0 ) {
                                echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste de footer est vide</p>
                            </div>';
                            }
                            else {
                                ?>
                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Liste d'élements</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable_formation" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>#id</th>
                                                    <th>Telephone</th>
                                                    <th>Localisation</th>
                                                    <th>Site web</th>
                                                    <th>email</th>
                                                    <th>H d'ouverture</th>
                                                    <th>H Fermeture</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#id</th>
                                                    <th>Telephone</th>
                                                    <th>Localisation</th>
                                                    <th>Site web</th>
                                                    <th>email</th>
                                                    <th>H d'ouverture</th>
                                                    <th>H Fermeture</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>

                                                <?php
                                                foreach (App::getDB()->query('SELECT * FROM footer
                                                                                                   ORDER BY id DESC') AS $mod):

                                                    echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Phone">'.$mod->phone.'</td> 
                                                <td title="localisation">'.$mod->localisation.'</td>
                                                <td title="web_site">'.$mod->web_site.'</td>
                                                <td title="email">'.$mod->email.'</td>
                                                <td title="h_ouverture">'.$mod->h_ouverture.'</td>
                                                <td title="h_fermeture">'.$mod->h_fermeture.'</td>
                                                <td title="Modifier"><a href="list.php?id=2&updateFt='.$mod->id.'">Modifier</a></td>
                                                <td title="Supprimer"><a href="list.php?id=2&delFt='.$mod->id.'" onclick="deleteFt('.$mod->id.'); return false;">Supprimer</a></td>
                                            </tr>';
                                                endforeach;
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
                <script>
                    function deleteFt(element){
                        if(confirm("Êtes-vous sur de vouloir supprimer cette element?")){
                            console.log('suppression effectué avec succès');


                            setTimeout(function () {
                                $(location).attr('href',"controllers/traitement.php?delFt="+ element);
                            }, 3000);


                        }else {
                            console.log('suppression annulé');
                        }
                    }
                </script>
            </div>

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php require 'footer.php';?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<?php require 'allMyModal.php';?>
<?php require 'required_js.php';?>

</body>

</html>

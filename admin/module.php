<?php
require '../app/config/Config_Server.php';

if(isset($_GET['id'])){
    define('HEADER_ID', $_GET['id']);
}else{
    define('HEADER_ID', 1);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Tableau de Bord</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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

            <!-- Begin Page Content -->
            <div class="container-fluid">


                <?php
                //formation
                if($_GET['name'] == 'formation'){
                    ?>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Border Left Utilities -->
                        <div class="col-lg-6">
                            <div id="rapportSupp" class="alert alert-danger" style="display:none;"></div>
                            <?php
                            if(isset($_GET['updateM'])){
                            foreach (App::getDB()->query('SELECT * FROM module WHERE id='.$_GET['updateM']) AS $mod):
                            ?>
                            <h1 class="h3 mb-1 text-gray-800">Modifier un Module</h1>
                            <div id="rapportMod" class="alert alert-danger" style="display:none;"></div>
                            <form class="user form_module" role="form"
                                  action="controllers/traitement.php?updateM=update" method="post">
                                <input type="hidden" name="modID" value="<?=$mod->id;?>">

                                <div class="form-group">
                                    <input type="text" class="form-control" name="lbl" id="lbl"
                                           aria-describedby="lbl" placeholder="Libelle*" value="<?=$mod->libelle;?>">
                                </div>

                                <div class="form-group">
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description">
                                            <?=$mod->description;?>
                                        </textarea>
                                </div>

                                <div class="form-group">
                                    <input type="number" class="form-control" name="prix" id="prix"
                                           aria-describedby="prix" placeholder="Prix" value="<?=$mod->prix;?>">
                                </div>

                                <div class="form-group">
                                    <label class="my-1 mr-2" for="frequence">Fréquence de paiement</label>
                                    <select class="my-1" id="duree" name="duree">
                                        <?php
                                        for ($i = 0; $i < 50; $i++){
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <span>/</span>
                                    <select class="my-1" id="frequence" name="frequence">
                                        <?php
                                        foreach (App::getDB()->query('SELECT id, libelle FROM frequence_paiement ORDER BY id DESC') AS $frequence):
                                            echo '<option value="' . $frequence->id . '">' . $frequence->libelle . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
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
                            $result = App::getDB()->rowCount('SELECT id FROM module');

                            // Si une erreur survient
                            if($result == 0 ) {
                                echo '<h1 class="h3 mb-1 text-gray-800">Ajout des Modules</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#module_list">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Modules</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste de Module est vide</p>
                            </div>';
                            }
                            else {
                            ?>

                            <h1 class="h3 mb-1 text-gray-800">Ajout des Modules</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#module_list">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Modules</span>
                                </a>
                            </div>
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Liste des Modules</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable_module" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Libelle</th>
                                                <th>Description</th>
                                                <th>Prix</th>
                                                <th>Durée</th>
                                                <th>Modifier</th>
                                                <th>Supprimer</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>#id</th>
                                                <th>Libelle</th>
                                                <th>Description</th>
                                                <th>Prix</th>
                                                <th>Durée</th>
                                                <th>Modifier</th>
                                                <th>Supprimer</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php
                                            foreach (App::getDB()->query('SELECT module.id AS myID, module.libelle AS mLbl, module.description AS mDesc,
                                                                                   prix, duree, frequence_paiement.libelle AS fpLbl FROM module
                                                                                   INNER JOIN frequence_paiement
                                                                                   ON module.frequence_paiement_id = frequence_paiement.id
                                                                                   ORDER BY myID DESC') AS $mod):

                                                echo '<tr>
                                                <td title="ID">#'.$mod->myID.'</td>
                                                <td title="Libelle">'.$mod->mLbl.'</td> 
                                                <td title="Description">'.$mod->mDesc.'</td>
                                                <td title="Prix">'.$mod->prix.'</td>
                                                <td title="Prix">'.$mod->duree.'/'.$mod->fpLbl.'</td>
                                                <td title="Modifier"><a href="module.php?name=formation&updateM='.$mod->myID.'">Modifier</a></td>
                                                <td title="Supprimer"><a href="module.php?name=formation&delM='.$mod->myID.'" onclick="deleteModule('.$mod->myID.'); return false;">Supprimer</a></td>
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
                            function deleteModule(element){
                               if(confirm("Êtes-vous sur de vouloir supprimer ce module?")){
                                   console.log('suppression effectué avec succès');

                                   var cat = document.getElementById('rapportSupp');
                                   cat.classList.remove('alert-danger');
                                   cat.classList.add('alert-success');
                                   cat.innerHTML += 'Le module a été supprimé avec succès';
                                   cat.style.display = 'block';

                                   setTimeout(function () {
                                       $(location).attr('href',"controllers/traitement.php?delM="+ element);
                                   }, 3000);


                               }else {
                                   console.log('suppression annulé');
                               }
                            }

                            function deleteFormation(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer cette formation?")){
                                    console.log('suppression effectué avec succès');

                                    var cat = document.getElementById('rapportSuppF');
                                    cat.classList.remove('alert-danger');
                                    cat.classList.add('alert-success');
                                    cat.innerHTML += 'cette formation a été supprimé avec succès';
                                    cat.style.display = 'block';

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delF="+ element);
                                    }, 3000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }

                        </script>

                        <!-- Border Bottom Utilities -->
                        <div class="col-lg-6">
                            <div id="rapportSuppF" class="alert alert-danger" style="display:none;"></div>
                            <?php
                            if(isset($_GET['updateF'])){
                            foreach (App::getDB()->query('SELECT * FROM formation WHERE headers_id="'.HEADER_ID.'" AND  id='.$_GET['updateF']) AS $mod):
                            ?>
                                <h1 class="h3 mb-1 text-gray-800">Modifier une Formation</h1>
                                <div id="rapportModif" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_formation" role="form"
                                      action="controllers/traitement.php?updateF=update" method="post">
                                    <input type="hidden" name="formID" value="<?=$mod->id;?>">
                                    <input type="hidden" name="header_id" value="<?= HEADER_ID;?>">
                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="listmodule">Liste des modules</label>
                                        <select class="custom-select my-1 mr-sm-2" id="listmodule" name="listmodule">
                                            <?php
                                            foreach (App::getDB()->query('SELECT id, libelle FROM module') AS $module):
                                                echo '<option value="' . $module->id . '">' . $module->libelle . '</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="lbl" id="lbl"
                                               aria-describedby="lbl" placeholder="Libelle*" value="<?=$mod->libelle;?>">
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description">
                                            <?=$mod->description;?>
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" class="form-control" name="prix" id="prix"
                                               aria-describedby="prix" placeholder="Prix" value="<?=$mod->prix;?>">
                                    </div>

                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="frequence">Fréquence de paiement</label>
                                        <select class="custom-select my-1 mr-sm-2" id="frequence" name="frequence">
                                            <?php
                                            foreach (App::getDB()->query('SELECT id, libelle FROM frequence_paiement ORDER BY id DESC') AS $frequence):
                                                echo '<option value="' . $frequence->id . '">' . $frequence->libelle . '</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="etat">Etat</label>
                                        <select class="custom-select my-1 mr-sm-2" id="etat" name="etat">
                                            <option selected value="0">disponible</option>
                                            <option value="1">Indisponible</option>
                                        </select>
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
                            $result = App::getDB()->rowCount('SELECT id FROM formation WHERE headers_id="'.HEADER_ID.'"');

                            // Si une erreur survient
                            if($result == 0 ) {
                                echo '<h1 class="h3 mb-1 text-gray-800">Ajout des Formations</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#formation_list">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Modules</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste de Formations est vide</p>
                            </div>';
                            }
                            else {
                            ?>
                            <h1 class="h3 mb-1 text-gray-800">Ajout des Formations</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#formation_list">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Formation</span>
                                </a>
                            </div>
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Liste des Formations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable_formation" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Libelle</th>
                                                <th>Description</th>
                                                <th>Prix</th>
                                                <th>Etat</th>
                                                <th>Categorie</th>
                                                <th>Modifier</th>
                                                <th>Supprimer</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>#id</th>
                                                <th>Libelle</th>
                                                <th>Description</th>
                                                <th>Prix</th>
                                                <th>Etat</th>
                                                <th>Categorie</th>
                                                <th>Modifier</th>
                                                <th>Supprimer</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>

                                            <?php
                                            foreach (App::getDB()->query('SELECT formation.id AS myID, formation.libelle AS lbl1, formation.description AS desc1, 
                                                                                   module.prix AS prix, formation.etat AS etat, module.libelle AS lbl2 FROM formation
                                                                                   INNER JOIN module 
                                                                                   ON formation.module_id=module.id
                                                                                   WHERE headers_id="'.HEADER_ID.'"
                                                                                   ORDER BY myID DESC') AS $mod):

                                                echo '<tr>
                                                <td title="ID">#'.$mod->myID.'</td>
                                                <td title="Libelle">'.$mod->lbl1.'</td> 
                                                <td title="Description">'.$mod->desc1.'</td>
                                                <td title="Prix">'.$mod->prix.'</td>
                                                <td title="Etat">'.(($mod->etat) == 0 ? "Disponible" : "Indisponible").'</td>
                                                <td title="Categorie">'.$mod->lbl2.'</td>
                                                <td title="Modifier"><a href="module.php?name=formation&updateF='.$mod->myID.'&id='.HEADER_ID.'">Modifier</a></td>
                                                <td title="Supprimer"><a href="module.php?name=formation&delF='.$mod->myID.'&id='.HEADER_ID.'" onclick="deleteFormation('.$mod->myID.'); return false;">Supprimer</a></td>
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
                // Equipe pédagogique
                else if($_GET['name'] == 'equipe_ped'){
                    ?>
                <div class="row">
                    <!-- Border Left Utilities -->
                    <div class="col-lg-12">
                        <?php
                        if(isset($_GET['updateEquipP'])){
                            foreach (App::getDB()->query('SELECT * FROM users WHERE user_type="0" AND id='.$_GET['updateEquipP']) AS $mod):
                                ?>
                                <h1 class="h3 mb-1 text-gray-800">Modifier utilisateur</h1>
                                <div id="rapportEquipP2" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_EquipP" role="form"
                                      action="controllers/traitement.php?updateEquipP=update" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="hideID" value="<?=$mod->id;?>">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="last_name" id="nom"
                                               aria-describedby="nom" placeholder="Nom*" value="<?=$mod->last_name;?>" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="first_name" id="prenom"
                                               aria-describedby="prenom" placeholder="Prenom*" value="<?=$mod->first_name;?>" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="profession" id="profession"
                                               aria-describedby="profession" required placeholder="profession*" value="<?=$mod->profession;?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="avatar">Photo de profil</label>
                                        <input type="file" class="form-control" name="avatar" id="avatar"
                                               aria-describedby="avatar" required placeholder="avatar*">
                                    </div>


                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email"
                                               aria-describedby="email" placeholder="email" value="<?=$mod->email;?>">
                                    </div>


                                    <div class="form-group">
                                        <input type="url" class="form-control" name="twitter" id="twitter"
                                               aria-describedby="twitter" placeholder="twitter" value="<?=$mod->twitter;?>">
                                    </div>


                                    <div class="form-group">
                                        <input type="url" class="form-control" name="facebook" id="facebook"
                                               aria-describedby="facebook" placeholder="facebook" value="<?=$mod->facebook;?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="url" class="form-control" name="instagram" id="instagram"
                                               aria-describedby="instagram" placeholder="instagram" value="<?=$mod->instagram;?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="url" class="form-control" name="linkedin" id="linkedin"
                                               aria-describedby="linkedin" placeholder="linkedin" value="<?=$mod->linkedin;?>">
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
                            $result = App::getDB()->rowCount('SELECT id FROM users WHERE user_type=0');

                            // Si une erreur survient
                            if($result == 0 ) {
                                echo '<h1 class="h3 mb-1 text-gray-800">Ajout des Utilisteurs</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#equipeP">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Equipe Pédagogique</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste d\'Equipe Pédagogique est vide</p>
                            </div>';
                            }
                            else {
                                ?>
                                <h1 class="h3 mb-1 text-gray-800">Ajout de l'Equipe Pédagogique</h1>
                                <div class="card mb-4 py-3 border-left-primary">
                                    <a class="card-body" href="#" data-toggle="modal" data-target="#equipeP">
                                        <i class="fas fa-fw fa-plus"></i>
                                        <span>Equipe Pédagogique</span>
                                    </a>
                                </div>
                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Liste de l'équipe Pédagogique</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable_module" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>#id</th>
                                                    <th class="text-center"><i class="fas fa-fw fa-user"></i></th>
                                                    <th><i class="icofont-worker"></i></th>
                                                    <th><i class="fas fa-fw fa-image"></i></th>
                                                    <th class="text-center"><i class="fas fa-fw fa-mail-bulk"></i></th>
                                                    <th class="text-center"><i class="fas fa-fw fa-twitter-square"></i></th>
                                                    <th class="text-center"><i class="fas fa-fw fa-facebook"></i></th>
                                                    <th class="text-center"><i class="fas fa-fw fa-instagram"></i></th>
                                                    <th class="text-center"><i class="fas fa-fw fa-linkedin-in"></i></th>
                                                    <th>Créee</th>
                                                    <th>Mise à jour</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#id</th>
                                                    <th>Nom&Prenom</th>
                                                    <th>Profession</th>
                                                    <th>Avatar</th>
                                                    <th>Email</th>
                                                    <th>Twitter</th>
                                                    <th>Facebook</th>
                                                    <th>Instagram</th>
                                                    <th>LinkedIn</th>
                                                    <th>Créee</th>
                                                    <th>Mise à jour</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php
                                                foreach (App::getDB()->query('SELECT * FROM users
                                                                                       WHERE user_type="0"
                                                                                       ORDER BY id DESC') AS $mod):

                                                    echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Nom&Prenom">'.$mod->first_name .' '. $mod->last_name .'</td> 
                                                <td title="Profession">'.$mod->profession .'</td>
                                                <td title="Avatar"><img class="img-fluid" src="'.$mod->avatar = str_replace('../../', '../', $mod->avatar).'" alt="'.$mod->first_name .'" title="'.$mod->first_name .'"></td>
                                                <td title="Email">'.$mod->email.'</td>
                                                <td title="Twitter">'.$mod->twitter.'</td>
                                                <td title="Facebook">'.$mod->facebook.'</td>
                                                <td title="Instagram">'.$mod->instagram.'</td>
                                                <td title="LinkedIn">'.$mod->linkedin.'</td>
                                                <td title="Créee">'.date('d/m/Y H:i:s', $mod->created_at).'</td> 
                                                <td title="Mise à jour">'. date('d/m/Y H:i:s', $mod->updated_at).'</td>  
                                                <td title="Modifier" class="text-center"><a href="module.php?name=equipe_ped&updateEquipP='.$mod->id.'"><i class="fas fa-fw fa-history"></i> </a></td>
                                                <td title="Supprimer" class="text-center"><a href="module.php?name=equipe_ped&delEquipP='.$mod->id.'" onclick="deleteUser('.$mod->id.'); return false;"><i class="fas fa-fw fa-trash"></i></a></td>
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

                        function deleteUser(element){
                            if(confirm("Êtes-vous sur de vouloir supprimer cet utilisateur ?")){
                                console.log('suppression effectué avec succès');

                                var cat = document.getElementById('rapportModifEquipP');
                                cat.classList.remove('alert-danger');
                                cat.classList.add('alert-success');
                                cat.innerHTML += 'Utilisateur supprimé avec succès';
                                cat.style.display = 'block';

                                setTimeout(function () {
                                    $(location).attr('href',"controllers/traitement.php?delEquipP="+ element);
                                }, 3000);


                            }else {
                                console.log('suppression annulé');
                            }
                        }

                    </script>
                </div>
                <?php
                }
                // partenaire
                else if($_GET['name'] == 'partenaire'){
                    ?>
                    <div class="row">
                        <!-- Border Left Utilities -->
                        <div class="col-lg-12">
                            <?php
                            if(isset($_GET['updatePartenaire'])){
                                foreach (App::getDB()->query('SELECT * FROM partenaires WHERE id='.$_GET['updatePartenaire']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier logo partenaire</h1>
                                    <div id="rapportPartenaire" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_Partenaire" role="form"
                                          action="controllers/traitement.php?updatePartenaire=update" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="hideID" value="<?=$mod->id;?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" id="name"
                                                   aria-describedby="name" placeholder="Nom du partenaire*" value="<?=$mod->name;?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="logo_partenaire">Logo du partenaire *</label>
                                            <input type="file" class="form-control" name="logo_partenaire" id="logo_partenaire"
                                                   aria-describedby="logo_partenaire" required >
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
                                $result = App::getDB()->rowCount('SELECT id FROM partenaires');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '<h1 class="h3 mb-1 text-gray-800">Ajouter un Partenaire</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#module_partenaire">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Logo Partenaire</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste de partenaires est vide</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Ajout des partenaires</h1>
                                    <div class="card mb-4 py-3 border-left-primary">
                                        <a class="card-body" href="#" data-toggle="modal" data-target="#module_partenaire">
                                            <i class="fas fa-fw fa-plus"></i>
                                            <span>Partenaires</span>
                                        </a>
                                    </div>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste des partenaires</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_module" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th class="text-center"><i class="fas fa-fw fa-user"></i></th>
                                                        <th><i class="fas fa-fw fa-image"></i></th>
                                                        <th>Ajouté</th>
                                                        <th>Mise à jour</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Nom du partenaire</th>
                                                        <th>Logo</th>
                                                        <th>Ajouté</th>
                                                        <th>Mise à jour</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM partenaires
                                                                                       ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Nom du partenaire">'.$mod->name.'</td> 
                                                <td title="Logo"><img class="img-thumbnail" src="'.$mod->img_url = str_replace('../../', '../', $mod->img_url).'" alt="'.$mod->name .'" title="'.$mod->name .'"></td>
                                                <td title="Créee">'.date('d/m/Y H:i:s', $mod->created_at).'</td> 
                                                <td title="Mise à jour">'. date('d/m/Y H:i:s', $mod->updated_at).'</td> 
                                                <td title="Modifier" class="text-center"><a href="module.php?name=partenaire&updatePartenaire='.$mod->id.'"><i class="fas fa-fw fa-history"></i> </a></td>
                                                <td title="Supprimer" class="text-center"><a href="module.php?name=partenaire&delPartenaire='.$mod->id.'" onclick="deletePartenaire('.$mod->id.'); return false;"><i class="fas fa-fw fa-trash"></i></a></td>
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

                            function deletePartenaire(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer ce logo partenaire ?")){
                                    console.log('suppression effectué avec succès');

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delPartenaire="+ element);
                                    }, 1000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }

                        </script>
                    </div>
                    <?php
                }
                //Vie Associative
                else if($_GET['name'] == 'vie_ass'){
                    $_ENV['header_id'] = $_GET['id'];
                    ?>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Border Left Utilities -->
                        <div class="col-lg-6">
                            <div id="rapportVASupp" class="alert alert-danger" style="display:none;"></div>
                            <?php
                            if(isset($_GET['updateVA'])){
                                foreach (App::getDB()->query('SELECT * FROM vie_ass WHERE id='.$_GET['updateVA']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier via associative</h1>
                                    <div id="rapportModiVA" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_via_ass" role="form"
                                          action="controllers/traitement.php?updateVA=update" method="post">
                                        <input type="hidden" name="hideID" value="<?=$mod->id;?>">
                                        <input type="hidden" name="header_id" value="<?= isset($_ENV['header_id'])? $_ENV['header_id'] : '1' ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="lbl" id="lbl"
                                                   aria-describedby="lbl" placeholder="Libelle*" value="<?=$mod->libelle;?>">
                                        </div>

                                        <div class="form-group">
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description">
                                            <?=$mod->description;?>
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
                                $result = App::getDB()->rowCount('SELECT id FROM vie_ass WHERE headers_id='.$_ENV['header_id'].' ');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '<h1 class="h3 mb-1 text-gray-800">Ajout d\'un Element</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#vie_ass">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>VIE ASSOCIATIVE</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste d\'élements de la vie Associative est vide.</p>
                            </div>';
                                }
                                else {
                                    ?>

                                    <h1 class="h3 mb-1 text-gray-800">Ajout vie associative</h1>
                                    <div class="card mb-4 py-3 border-left-primary">
                                        <a class="card-body" href="#" data-toggle="modal" data-target="#vie_ass">
                                            <i class="fas fa-fw fa-plus"></i>
                                            <span>Vie Associative</span>
                                        </a>
                                    </div>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Vie Associative</h6>
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
                                                    foreach (App::getDB()->query('SELECT * FROM vie_ass
                                                                                           WHERE headers_id='.$_ENV['header_id'].' 
                                                                                           ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Libelle">'.$mod->libelle.'</td> 
                                                <td title="Description">'.$mod->description.'</td>
                                                <td title="Modifier" class="text-center"><a href="module.php?name=vie_ass&updateVA='.$mod->id.'&id='.$_ENV['header_id'].'"><i class="fas fa-fw fa-history"></i></a></td>
                                                <td title="Supprimer" class="text-center"><a href="module.php?name=vie_ass&delVA='.$mod->id.'&id='.$_ENV['header_id'].'" onclick="deleteVA('.$mod->id.', '.$_ENV['header_id'].'); return false;"><i class="fas fa-fw fa-trash"></i></a></td>
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
                            function deleteVA(element, element2){
                                if(confirm("Êtes-vous sur de vouloir supprimer cet élement ?")){
                                    console.log('suppression effectué avec succès');

                                    var cat = document.getElementById('rapportVASupp');
                                    cat.classList.remove('alert-danger');
                                    cat.classList.add('alert-success');
                                    cat.innerHTML += 'cet élement a été supprimé avec succès';
                                    cat.style.display = 'block';

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delVA="+ element + "&id=" + element2);
                                    }, 1000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }

                            function deleteIMGVA(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer cette image ?")){
                                    console.log('suppression effectué avec succès');

                                    var cat = document.getElementById('rapportIMGVASupp');
                                    cat.classList.remove('alert-danger');
                                    cat.classList.add('alert-success');
                                    cat.innerHTML += 'cette image a été supprimé avec succès';
                                    cat.style.display = 'block';

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delIMGva="+ element);
                                    }, 1000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }

                        </script>

                        <!-- Border Bottom Utilities -->
                        <div class="col-lg-6">
                            <div id="rapportIMGVASupp" class="alert alert-danger" style="display:none;"></div>
                            <?php
                            if(isset($_GET['updateIMGva'])){
                                foreach (App::getDB()->query('SELECT * FROM images WHERE id='.$_GET['updateIMGva']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier une Image</h1>
                                    <div id="rapportVAModif" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_img_va" role="form"
                                          action="controllers/traitement.php?updateIMGva=update" method="post">
                                        <input type="hidden" name="hideID" value="<?=$mod->id;?>">

                                        <div class="form-group">
                                            <label class="my-1 mr-2" for="img_url">Inserer une Image</label>
                                            <input type="file" name="img_url" id="img_url" required>
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
                                $result = App::getDB()->rowCount('SELECT id FROM images WHERE vie_ass_id=1');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '<h1 class="h3 mb-1 text-gray-800">Ajout d\'une image</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#img_vie_ass">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>IMAGE ASSOCIATION</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste des images de l\'association est vide</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Ajout des images de l'association</h1>
                                    <div class="card mb-4 py-3 border-left-primary">
                                        <a class="card-body" href="#" data-toggle="modal" data-target="#img_vie_ass">
                                            <i class="fas fa-fw fa-plus"></i>
                                            <span>Image Association</span>
                                        </a>
                                    </div>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste des images de l'association</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_formation" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Images</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Images</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>

                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM images
                                                                                   WHERE vie_ass_id=1 
                                                                                   ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Images"><img class="img-fluid" src="'.$mod->url = str_replace('../../', '../', $mod->url) .'" alt="'.$mod->url .'"></td>
                                                <td title="Modifier" class="text-center"><a href="module.php?name=vie_ass&updateIMGva='.$mod->id.'"><i class="fas fa-fw fa-history"></i></a></td>
                                                <td title="Supprimer" class="text-center"><a href="module.php?name=vie_ass&delIMGva='.$mod->id.'" onclick="deleteIMGVA('.$mod->id.'); return false;"><i class="fas fa-fw fa-trash"></i></a></td>
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
                // cours de langue
                else if($_GET['name'] == 'langue'){
                    ?>
                    <div class="row">
                        <!-- Border Left Utilities -->
                        <div class="col-lg-12">
                            <?php
                            if(isset($_GET['updateLangue'])){
                                foreach (App::getDB()->query('SELECT * FROM langues WHERE id='.$_GET['updateLangue']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier un cours de langue</h1>
                                    <div id="rapportLangue" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_langue" role="form"
                                          action="controllers/traitement.php?updateLangue=update" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="hideID" value="<?=$mod->id;?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" id="name"
                                                   aria-describedby="name" placeholder="Nom du cours*" value="<?=$mod->libelle;?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="desc">Description</label>
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description">
                                            <?=$mod->description;?>
                                        </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="img_url">Image descriptive *</label>
                                            <input type="file" class="form-control" name="img_url" id="img_url"
                                                   aria-describedby="img_url" required >
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
                                $result = App::getDB()->rowCount('SELECT id FROM langues');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '<h1 class="h3 mb-1 text-gray-800">Ajouter un cours de langue</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#module_langue">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Cours de langues</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste de cours de langues</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Ajouter un cours de langue</h1>
                                    <div class="card mb-4 py-3 border-left-primary">
                                        <a class="card-body" href="#" data-toggle="modal" data-target="#module_langue">
                                            <i class="fas fa-fw fa-plus"></i>
                                            <span>Cours de langues</span>
                                        </a>
                                    </div>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste des Cours de langues</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_module" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Nom du Cours</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Nom du Cours</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM langues
                                                                                       ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Nom du Cours">'.$mod->libelle.'</td> 
                                                <td title="Description">'.$mod->description.'</td> 
                                                <td title="Image"><img class="img-fluid" src="'.$mod->img_url = str_replace('../../', '../', $mod->img_url).'" alt="'.$mod->libelle .'" title="'.$mod->libelle .'"></td>
                                                <td title="Modifier" class="text-center"><a href="module.php?name=langue&updateLangue='.$mod->id.'"><i class="fas fa-fw fa-history"></i> </a></td>
                                                <td title="Supprimer" class="text-center"><a href="module.php?name=langue&delLangue='.$mod->id.'" onclick="deleteLangue('.$mod->id.'); return false;"><i class="fas fa-fw fa-trash"></i></a></td>
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

                            function deleteLangue(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer ce cours ?")){
                                    console.log('suppression effectué avec succès');

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delLangue="+ element);
                                    }, 1000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }

                        </script>
                    </div>
                    <?php
                }
                //valorisation des acquis de l'expérience
                else if($_GET['name'] == 'vae'){
                    ?>
                    <div class="row">
                        <!-- Border Left Utilities -->
                        <div class="col-lg-6">
                            <?php
                            if(isset($_GET['updateVAE'])){
                                foreach (App::getDB()->query('SELECT * FROM vae WHERE vae_etat="0" AND id='.$_GET['updateVAE']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier</h1>
                                    <div id="rapportVAE" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_vae" role="form"
                                          action="controllers/traitement.php?updateVAE=vae" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="hideID" value="<?=$mod->id;?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" id="name"
                                                   aria-describedby="name" placeholder="Libelle*" value="<?=$mod->libelle;?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="desc">Description</label>
                                            <textarea class="form-control" aria-describedby="desc"
                                                      name="desc" id="desc" cols="10" rows="3"
                                                      placeholder="Description">
                                            <?=$mod->description;?>
                                        </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="img_url">Image descriptive *</label>
                                            <input type="file" class="form-control" name="img_url" id="img_url"
                                                   aria-describedby="img_url" required >
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
                                $result = App::getDB()->rowCount('SELECT id FROM vae WHERE vae_etat="0"');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '<h1 class="h3 mb-1 text-gray-800">Ajouter une vae</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#vae">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Valorisation des acquis de l\'expérience</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste d\'informations sur la vae est vide</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Ajouter les informations sur la VAE</h1>
                                    <div class="card mb-4 py-3 border-left-primary">
                                        <a class="card-body" href="#" data-toggle="modal" data-target="#vae">
                                            <i class="fas fa-fw fa-plus"></i>
                                            <span>Valorisation des acquis de l'expérience</span>
                                        </a>
                                    </div>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste d'information sur la VAE</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_module" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM vae
                                                                                           WHERE vae_etat="0"
                                                                                           ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Libelle">'.$mod->libelle.'</td> 
                                                <td title="Description">'.$mod->description.'</td> 
                                                <td title="Image"><img class="img-fluid" src="'.$mod->img_url = str_replace('../../', '../', $mod->img_url).'" alt="'.$mod->libelle .'" title="'.$mod->libelle .'"></td>
                                                <td title="Modifier" class="text-center"><a href="module.php?name=vae&updateVAE='.$mod->id.'"><i class="fas fa-fw fa-history"></i> </a></td>
                                                <td title="Supprimer" class="text-center"><a href="module.php?name=vae&delVAE='.$mod->id.'" onclick="deleteVAE('.$mod->id.'); return false;"><i class="fas fa-fw fa-trash"></i></a></td>
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
                        <!--Elements à fournir-->
                        <div class="col-lg-6">
                            <?php
                            if(isset($_GET['updateVAEItem'])){
                                foreach (App::getDB()->query('SELECT * FROM vae WHERE vae_etat="1" AND id='.$_GET['updateVAEItem']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier</h1>
                                    <div id="rapportVAE4" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_vae" role="form"
                                          action="controllers/traitement.php?updateVAEItem=vae" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="hideID" value="<?=$mod->id;?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" id="name"
                                                   aria-describedby="name" placeholder="Libelle*" value="<?=$mod->libelle;?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="desc">Description</label>
                                            <textarea class="form-control" aria-describedby="desc"
                                                      name="desc" id="desc" cols="10" rows="3"
                                                      placeholder="Description">
                                            <?=$mod->description;?>
                                        </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="img_url">Image descriptive </label>
                                            <input type="file" class="form-control" name="img_url" id="img_url"
                                                   aria-describedby="img_url">
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
                                $result = App::getDB()->rowCount('SELECT id FROM vae WHERE vae_etat="1"');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '<h1 class="h3 mb-1 text-gray-800">Ajouter un Element</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#vae_item">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Elements à fournir</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste d\'élements est vide</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Ajouter les informations sur la VAE</h1>
                                    <div class="card mb-4 py-3 border-left-primary">
                                        <a class="card-body" href="#" data-toggle="modal" data-target="#vae_item">
                                            <i class="fas fa-fw fa-plus"></i>
                                            <span>Elements à fournir</span>
                                        </a>
                                    </div>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste d'informations à fournir</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_module" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Element</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Element</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM vae WHERE vae_etat="1"
                                                                                       ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Element">'.$mod->libelle.'</td> 
                                                <td title="Description">'.$mod->description.'</td> 
                                                <td title="Image"><img class="img-fluid" src="'.$mod->img_url = str_replace('../../', '../', $mod->img_url).'" alt="'.$mod->libelle .'" title="'.$mod->libelle .'"></td>
                                                <td title="Modifier" class="text-center"><a href="module.php?name=vae&updateVAEItem='.$mod->id.'"><i class="fas fa-fw fa-history"></i> </a></td>
                                                <td title="Supprimer" class="text-center"><a href="module.php?name=vae&delVAEItem='.$mod->id.'" onclick="deleteVAEItem('.$mod->id.'); return false;"><i class="fas fa-fw fa-trash"></i></a></td>
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

                            function deleteVAE(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer cette information ?")){
                                    console.log('suppression effectué avec succès');

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delVAE="+ element);
                                    }, 1000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }


                            function deleteVAEItem(element) {
                                if(confirm("Êtes-vous sur de vouloir supprimer cet element ?")){
                                    console.log('suppression effectué avec succès');

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delVAEItem="+ element);
                                    }, 1000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }

                        </script>
                    </div>
                    <?php
                }
                //programme d'assistance jeune
                else if($_GET['name'] == 'paj'){
                    ?>
                    <div class="row">
                        <!-- Border Left Utilities -->
                        <div class="col-lg-12">
                            <?php
                            if(isset($_GET['updatePAJ'])){
                                foreach (App::getDB()->query('SELECT * FROM paj WHERE id='.$_GET['updatePAJ']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier</h1>
                                    <div id="rapportPAJ" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_paj" role="form"
                                          action="controllers/traitement.php?updatePAJ=vae" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="hideID" value="<?=$mod->id;?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" id="name"
                                                   aria-describedby="name" placeholder="Libelle*" value="<?=$mod->libelle;?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="desc">Description</label>
                                            <textarea class="form-control" aria-describedby="desc"
                                                      name="desc" id="desc" cols="10" rows="3"
                                                      placeholder="Description">
                                            <?=$mod->description;?>
                                        </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="img_url">Image descriptive </label>
                                            <input type="file" class="form-control" name="img_url" id="img_url"
                                                   aria-describedby="img_url" >
                                        </div>

                                        <div class="form-group">
                                            <label for="fichier">Fiche d'adhesion </label>
                                            <input type="file" class="form-control" name="fichier" id="fichier"
                                                   aria-describedby="fichier" >
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
                                $result = App::getDB()->rowCount('SELECT id FROM paj');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '<h1 class="h3 mb-1 text-gray-800">Ajouter un paj</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#paj">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Programme d\'assistance jeunes</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste d\'informations sur le paj est vide</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Ajouter les informations sur la PAJ</h1>
                                    <div class="card mb-4 py-3 border-left-primary">
                                        <a class="card-body" href="#" data-toggle="modal" data-target="#paj">
                                            <i class="fas fa-fw fa-plus"></i>
                                            <span>Programme d\'assistance jeunes</span>
                                        </a>
                                    </div>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste d'information sur le PAJ</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_module" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Fichier</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Fichier</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM paj
                                                                                       ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Libelle">'.$mod->libelle.'</td> 
                                                <td title="Description">'.$mod->description.'</td> 
                                                <td title="Image"><img class="img-fluid" src="'.$mod->img_url = str_replace('../../', '../', $mod->img_url).'" alt="'.$mod->libelle .'" title="'.$mod->libelle .'"></td>
                                                <td title="Télécharger"><a href="'.$mod->fichier.'" title="fiche">Télécharger</a></td> 
                                                <td title="Modifier" class="text-center"><a href="module.php?name=paj&updatePAJ='.$mod->id.'"><i class="fas fa-fw fa-history"></i> </a></td>
                                                <td title="Supprimer" class="text-center"><a href="module.php?name=paj&delPAJ='.$mod->id.'" onclick="deletePAJ('.$mod->id.'); return false;"><i class="fas fa-fw fa-trash"></i></a></td>
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

                            function deletePAJ(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer cette information ?")){
                                    console.log('suppression effectué avec succès');

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delPAJ="+ element);
                                    }, 1000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }

                        </script>
                    </div>
                    <?php
                }
                ?>

            </div>
            <!-- /.container-fluid -->

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

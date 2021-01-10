<?php
require '../app/config/Config_Server.php';
session_start();

if(isset($_SESSION['ID_USER'])) {
    $user_id = intval($_SESSION['ID_USER']);
    $last_name = $_SESSION['NOM_USER'];
    $first_name = $_SESSION['PRENOM_USER'];
}
else if(isset($_COOKIE['ID_USER'])) {
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

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="wysibb/src/css/wysiwyg.css" rel="stylesheet">
    <link href="wysibb/src/css/highlight.min.css" rel="stylesheet">

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
                //accueil
                if($_GET['id'] == 1){
                    ?>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-1 text-gray-800">Liste des éléments de la page d'accueil</h1>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Border Left Utilities -->
                        <div class="col-lg-6">

                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="module.php?name=formation&id=<?= $_GET['id'];?>">Formation</a>
                            </div>

                            <div class="card mb-4 py-3 border-left-secondary">
                                <a class="card-body" href="module.php?name=equipe_ped&id=<?= $_GET['id'];?>">Equipe Pédagogique</a>
                            </div>

                            <div class="card mb-4 py-3 border-left-success">
                                <a class="card-body" href="module.php?name=partenaire&id=<?= $_GET['id'];?>">Partenaires</a>
                            </div>

                            <div class="card mb-4 py-3 border-left-info">
                                <a class="card-body" href="module.php?name=vie_ass&id=<?= $_GET['id'];?>">Vie Associative</a>
                            </div>

                        </div>

                        <!-- Border Bottom Utilities -->
                        <div class="col-lg-6">

                            <div class="card mb-4 py-3 border-left-warning">
                                <a class="card-body" href="module.php?name=langue&id=<?= $_GET['id'];?>">Cours de Langue</a>
                            </div>

                            <div class="card mb-4 py-3 border-left-danger">
                                <a class="card-body" href="module.php?name=vae&id=<?= $_GET['id'];?>">Valorisation des acquis de l'expérience</a>
                            </div>

                            <div class="card mb-4 py-3 border-left-dark">
                                <a class="card-body" href="module.php?name=paj&id=<?= $_GET['id'];?>">Programme d'assistance Jeunes</a>
                            </div>
                            <!--<div class="card mb-4 py-3 border-bottom-primary">
                                <div class="card-body">
                                    .border-bottom-primary
                                </div>
                            </div>

                            <div class="card mb-4 py-3 border-bottom-secondary">
                                <div class="card-body">
                                    .border-bottom-secondary
                                </div>
                            </div>

                            <div class="card mb-4 py-3 border-bottom-success">
                                <div class="card-body">
                                    .border-bottom-success
                                </div>
                            </div>

                            <div class="card mb-4 py-3 border-bottom-info">
                                <div class="card-body">
                                    .border-bottom-info
                                </div>
                            </div>

                            <div class="card mb-4 py-3 border-bottom-warning">
                                <div class="card-body">
                                    .border-bottom-warning
                                </div>
                            </div>

                            <div class="card mb-4 py-3 border-bottom-danger">
                                <div class="card-body">
                                    .border-bottom-danger
                                </div>
                            </div>

                            <div class="card mb-4 py-3 border-bottom-dark">
                                <div class="card-body">
                                    .border-bottom-dark
                                </div>
                            </div>-->

                        </div>

                    </div>
                <?php
                }
                //Nos Programmes de formation
                else if($_GET['id'] == 2){

                }
                //Valorisation des acquis de l'expérience
                else if($_GET['id'] == 3){

                } //Cours de langue
                else if($_GET['id'] == 4){

                } //programme d'assistance jeunes
                else if($_GET['id'] == 5){

                } //Programmes associatifs
                else if($_GET['id'] == 6){
                    $_ENV['header_id'] = $_GET['id'];
                    ?>
                    <div class="row">
                        <!-- Border Left Utilities -->
                        <div class="col-lg-12">
                            <div id="rapportVASupp" class="alert alert-danger" style="display:none;"></div>
                            <?php
                            if(isset($_GET['updateVA'])){
                                foreach (App::getDB()->query('SELECT * FROM vie_ass WHERE id='.$_GET['updateVA']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier via associative</h1>
                                    <div id="rapportModiVA2" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_via_ass2" role="form"
                                          action="controllers/traitement.php?updateVA=update" method="post">
                                        <input type="hidden" name="hideID" value="<?=$mod->id;?>">
                                        <input type="hidden" name="header_id" value="<?= isset($_ENV['header_id'])? $_ENV['header_id'] : '6' ?>">
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

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupFileAddon01">Importer Image</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="img_url" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="inputGroupFile01">Facultatif</label>
                                            </div>
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
                            <div class="card mb-4 py-3 border-bottom-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#vie_ass2">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>PROGRAMMES ASSOCIATIFS</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste d\'élements du programme Associatif est vide.</p>
                            </div>';
                                }
                                else {
                                    ?>

                                    <h1 class="h3 mb-1 text-gray-800">Ajout d'un programme associatif</h1>
                                    <div class="card mb-4 py-3 border-left-primary">
                                        <a class="card-body" href="#" data-toggle="modal" data-target="#vie_ass2">
                                            <i class="fas fa-fw fa-plus"></i>
                                            <span>Programmes Associatifs</span>
                                        </a>
                                    </div>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Programmes Associatifs</h6>
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
                                                    foreach (App::getDB()->query('SELECT * FROM vie_ass
                                                                                           WHERE headers_id='.$_ENV['header_id'].' 
                                                                                           ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Libelle">'.$mod->libelle.'</td> 
                                                <td title="Description">'.$mod->description.'</td>
                                                <td title="Image"><img class="img-fluid" src="'.$mod->img_url = str_replace('../../', '../', $mod->img_url).'" alt="'.$mod->libelle .'"></td>
                                                <td title="Modifier" class="text-center"><a href="body.php?id='.$_ENV['header_id'].'&updateVA='.$mod->id.'"><i class="fas fa-fw fa-history"></i></a></td>
                                                <td title="Supprimer" class="text-center"><a href="body.php?id='.$_ENV['header_id'].'&delVA='.$mod->id.'" onclick="deleteVA('.$mod->id.', '.$_ENV['header_id'].'); return false;"><i class="fas fa-fw fa-trash"></i></a></td>
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
                        </script>
                    </div>
                <?php
                } //Apropos
                else if($_GET['id'] == 7){
                    ?>
                    <div class="row">
                        <!-- Border Left Utilities -->
                        <div class="col-lg-12">
                            <?php
                            if(isset($_GET['updateA'])){
                                foreach (App::getDB()->query('SELECT * FROM about WHERE id='.$_GET['updateA']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier Apropos</h1>
                                    <div id="rapportA" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_A" role="form"
                                          action="controllers/traitement.php?updateA=update" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="hideID" value="<?=$mod->id;?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="libelle" id="libelle"
                                                   aria-describedby="libelle" placeholder="Libelle*" value="<?=$mod->libelle;?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="description"></label>
                                            <textarea name="description" class="form-control" id="description" aria-describedby="description" cols="30" rows="5" placeholder="Description Apropos*"><?=$mod->description;?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="avatar">Image descriptive</label>
                                            <input type="file" class="form-control" name="avatar" id="avatar"
                                                   aria-describedby="avatar" placeholder="avatar*">
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
                                $result = App::getDB()->rowCount('SELECT id FROM about');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '<h1 class="h3 mb-1 text-gray-800">Ajouter Apropos</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="#" data-toggle="modal" data-target="#apropos">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Apropos</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste apropos est vide</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Ajouter Apropos</h1>
                                    <div class="card mb-4 py-3 border-left-primary">
                                        <a class="card-body" href="#" data-toggle="modal" data-target="#apropos">
                                            <i class="fas fa-fw fa-plus"></i>
                                            <span>Apropos</span>
                                        </a>
                                    </div>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste Apropos</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_module" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>description</th>
                                                        <th><i class="fas fa-fw fa-image"></i></th>
                                                        <th>Créee</th>
                                                        <th>Mise à jour</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>description</th>
                                                        <th><i class="fas fa-fw fa-image"></i></th>
                                                        <th>Créee</th>
                                                        <th>Mise à jour</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM about
                                                                                       ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Libelle">'.$mod->libelle .'</td> 
                                                <td title="Description">'.$mod->description .'</td>
                                                <td title="Avatar"><img class="img-fluid" src="'.$mod->img_url = str_replace('../../', '../', $mod->img_url).'" alt="'.$mod->libelle .'" title="'.$mod->libelle .'"></td>
                                                <td title="Créee">'.date('d/m/Y H:i:s', $mod->created_at).'</td> 
                                                <td title="Mise à jour">'. date('d/m/Y H:i:s', $mod->updated_at).'</td>  
                                                <td title="Modifier" class="text-center"><a href="body.php?id='.$_GET['id'] .'&updateA='.$mod->id.'"><i class="fas fa-fw fa-history"></i> </a></td>
                                                <td title="Supprimer" class="text-center"><a href="body.php?id='.$_GET['id'] .'&delA='.$mod->id.'" onclick="deleteA('.$mod->id.'); return false;"><i class="fas fa-fw fa-trash"></i></a></td>
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

                            function deleteA(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer apropos ?")){
                                    console.log('suppression effectué avec succès');

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delA="+ element);
                                    }, 3000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }

                        </script>
                    </div>
                <?php
                } //Blog
                else if($_GET['id'] == 8){
                    ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Blog</h1>
                    </div>

                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">

                                <div class="card mb-4 py-3 border-left-primary">
                                    <a class="card-body collapse-item" href="#" data-toggle="modal" data-target="#caterories">
                                        <i class="fas fa-fw fa-plus"></i>
                                        <span>Catégorie</span>
                                    </a>
                                </div>

                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card mb-4 py-3 border-left-success">
                                <a class="card-body collapse-item" href="#" data-toggle="modal" data-target="#tag">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Tag</span>
                                </a>
                            </div>
                        </div>

                        <!-- Tasks Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card mb-4 py-3 border-left-info">
                                <a class="card-body collapse-item" href="article.php">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Poster Articles</span>
                                </a>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card mb-4 py-3 border-left-warning">
                                <a class="card-body collapse-item" href="#">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Associé Article et Tag</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header m-0 font-weight-bold text-primary">
                                    Liste des categories
                                </div>
                                <div class="card-body">

                                    <?php
                                    if(isset($_GET['updateCat'])){
                                        foreach (App::getDB()->query('SELECT * FROM categories WHERE id='.$_GET['updateCat']) AS $cat):
                                            ?>
                                            <div class="alert alert-danger rapport" style="display:none;"></div>
                                            <form class="user" role="form" id="form_update_categories" action="controllers/traitement.php?updateCategories=update" method="post">
                                                <input type="hidden" name="category" value="<?=$cat->id;?>">
                                                <div class="form-group">
                                                    <label for="titre_categories"></label><input type="text" class="form-control" id="titre_categories" value="<?=$cat->title;?>" name="titre_categories" aria-describedby="titre_categories" placeholder="Titre Catégorie">
                                                </div>

                                                <div class="form-group">
                                                    <label for="desc_categories"></label><textarea name="desc_categories" class="form-control" id="desc_categories" aria-describedby="desc_categories" cols="30" rows="5" placeholder="Description Catégorie"><?=$cat->description;?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary btn-user btn-block currentSend" value="Modifier"/>
                                                    <center><img src="img/loader.gif" class="loader" style="display:none;" alt=""></center>
                                                </div>

                                            </form>
                                        <?php
                                        endforeach;
                                    } elseif (isset($_GET['delCat'])){
                                        App::getDB()->delete('DELETE FROM categories WHERE id=:id', ['id' =>$_GET['delCat']]);
                                        //header('Location: list_posts.php');
                                    } else{

                                        $result = App::getDB()->rowCount('SELECT id FROM categories');

                                        // Si une erreur survient
                                        if($result == 0 ) {
                                            echo '<p>Votre liste de Catégories est vide</p>';
                                        }
                                        else {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Titre</th>
                                                        <th>Description</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                        <th>Créee</th>
                                                        <th>Mise à jour</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Titre</th>
                                                        <th>Description</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                        <th>Créee</th>
                                                        <th>Mise à jour</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM categories
                                                                                ORDER BY id DESC') AS $category):
                                                        echo '<tr>
                                                        <td title="ID">#'.$category->id.'</td>
                                                        <td title="Titre">'.$category->title.'</td> 
                                                        <td title="Description">'.$category->description.'</td>
                                                        <td title="Modifier"><a href="list_posts.php?updateCat='.$category->id.'">Modifier</a></td>
                                                        <td title="Supprimer"><a href="list_posts.php?delCat='.$category->id.'">Supprimer</a></td>
                                                        <td title="Créee">'.date('d/m/Y H:i:s', $category->created_at).'</td> 
                                                        <td title="Mise à jour">'.date('d/m/Y H:i:s', $category->updated_at).'</td> 
                                                        <tr>';
                                                    endforeach;
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>


                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Dropdown Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Liste des Tags</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">


                                    <?php
                                    if(isset($_GET['updateTag'])){
                                        foreach (App::getDB()->query('SELECT * FROM tags WHERE id='.$_GET['updateTag']) AS $cat):
                                            ?>
                                            <div class="alert alert-danger rapport" style="display:none;"></div>
                                            <form class="user" role="form" id="form_update_tag" action="controllers/traitement.php?updateTag=update" method="post">
                                                <input type="hidden" name="tag_id" value="<?=$cat->id;?>">
                                                <div class="form-group">
                                                    <label for="titre_categories"></label><input type="text" class="form-control" id="titre_tag" value="<?=$cat->title;?>" name="titre_tag" aria-describedby="titre_tag" placeholder="Titre du Tag">
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary btn-user btn-block currentSend" value="Modifier"/>
                                                    <center><img src="img/loader.gif" class="loader" style="display:none;" alt=""></center>
                                                </div>

                                            </form>
                                        <?php
                                        endforeach;
                                    } elseif (isset($_GET['delTag'])){
                                        App::getDB()->delete('DELETE FROM tags WHERE id=:id', ['id' =>$_GET['delTag']]);
                                        //header('Location: list_posts.php');
                                    } else{

                                        $result = App::getDB()->rowCount('SELECT id FROM tags');

                                        // Si une erreur survient
                                        if($result == 0 ) {
                                            echo '<p>Votre liste de Tags est vide</p>';
                                        }
                                        else {
                                            ?>
                                            <!-- Begin Page Content -->
                                            <div class="">
                                                <!-- Page Heading -->

                                                <!-- DataTales Example -->

                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                        <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Titre</th>
                                                            <th>Modifier</th>
                                                            <th>Supprimer</th>
                                                            <th>Créee</th>
                                                            <th>Mise à jour</th>
                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Titre</th>
                                                            <th>Modifier</th>
                                                            <th>Supprimer</th>
                                                            <th>Créee</th>
                                                            <th>Mise à jour</th>
                                                        </tr>
                                                        </tfoot>
                                                        <tbody>
                                                        <?php
                                                        foreach (App::getDB()->query('SELECT * FROM tags
                                                                                ORDER BY id DESC') AS $category):
                                                            echo '<tr>
                                                        <td title="ID">#'.$category->id.'</td>
                                                        <td title="Titre">'.$category->title.'</td> 
                                                        <td title="Modifier"><a href="list_posts.php?updateTag='.$category->id.'">Modifier</a></td>
                                                        <td title="Supprimer"><a href="list_posts.php?delTag='.$category->id.'">Supprimer</a></td>
                                                        <td title="Créee">'.date('d/m/Y H:i:s', $category->created_at).'</td> 
                                                        <td title="Mise à jour">'.date('d/m/Y H:i:s', $category->updated_at).'</td> 
                                                        <tr>';
                                                        endforeach;
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                            <!-- /.container-fluid -->
                                            <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <?php
                            if(isset($_GET['updateArticle'])){
                                foreach (App::getDB()->query('SELECT * FROM posts WHERE id='.$_GET['updateArticle']) AS $mod):
                                    ?>
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Modifier Article!</h1>
                                    <div id="rapport_update" class="alert alert-danger rapport1" style="display:block;">Veuillez remplir tous les champs !</div>
                                </div>
                                <form class="user" role="form" id="form_article1" enctype="multipart/form-data">
                                    <input type="hidden" name="hideID" value="<?=$mod->id;?>">
                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="category_id">Selectionner une catégorie</label>
                                        <select class="custom-select my-1 mr-sm-2" id="category_id" name="category_id" style="font-size: 15px!important;">
                                            <?php
                                            foreach (App::getDB()->query('SELECT id, title FROM categories ORDER BY id DESC') AS $menu):
                                                echo '<option value="' . $menu->id . '">' . $menu->title . '</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="titre_article">Titre de votre article</label>
                                        <input type="text" class="form-control" id="titre_article" name="titre_article" aria-describedby="titre_article" placeholder="Titre de l'article" required value="<?=$mod->title;?>">
                                    </div>


                                    <div class="form-group"><label>Page de couverture</label>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                  <span class="input-group-btn">
                                  <span class="btn btn-default btn-file">Selectionner une image…
                                      <input type="file" id="imgInp1" name="imgInp" required>
                                  </span>
                                  </span>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <img id='img-upload1' class="img-fluid"/>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="desc_article1">Décrivez votre article</label>
                                        <textarea name="desc_article" id="desc_article1" class="form-control" cols="30" rows="10" required><?=htmlspecialchars_decode($mod->content);?></textarea>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <input style="font-size: 15px" type="submit" class="btn btn-primary btn-user btn-block currentSend" value="Publier"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;" alt=""></center>
                                    </div>

                                </form>
                                <?php
                                endforeach;
                            } else{
                                $result = App::getDB()->rowCount('SELECT id FROM posts');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '<h1 class="h3 mb-1 text-gray-800">Ajout un article</h1>
                            <div class="card mb-4 py-3 border-left-primary">
                                <a class="card-body" href="article.php">
                                    <i class="fas fa-fw fa-plus"></i>
                                    <span>Article Posté</span>
                                </a>
                            </div>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste d\'Articles est vide</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste d'articles postés</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_module" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Titre</th>
                                                        <th>Contenu</th>
                                                        <th><i class="fas fa-fw fa-image"></i></th>
                                                        <th>Catégorie</th>
                                                        <th>Posté par</th>
                                                        <th>Commentaires</th>
                                                        <th>Tags</th>
                                                        <th>Posté le</th>
                                                        <th>Mise à jour</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Titre</th>
                                                        <th>Contenu</th>
                                                        <th><i class="fas fa-fw fa-image"></i></th>
                                                        <th>Catégorie</th>
                                                        <th>Posté par</th>
                                                        <th>Commentaires</th>
                                                        <th>Tags</th>
                                                        <th>Posté le</th>
                                                        <th>Mise à jour</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT posts.id AS post, posts.title AS post_title, posts.content AS post_content, featured_image, post_type, likes, dislike, favourited, posts.created_at AS post_created, posts.updated_at AS post_updated, posts.user_id, category_id, 
                                                                                                  u.id, first_name, last_name, profession, email, twitter, facebook, instagram, linkedin, user_type, liked_posts, disliked_posts, favourites, favourite_categories, preference, u.created_at, u.updated_at, avatar, newsletter_id, objet, message, ip, 
                                                                                                  c.id, c.title AS cat_title, description AS cat_desc, color, c.created_at, c.updated_at, 
                                                                                                  c2.id, c2.content AS cmt_content, c2.created_at, c2.updated_at, c2.user_id, c2.post_id, 
                                                                                                  i.id, url_miniature, url, i.created_at, i.updated_at, i.post_id, vie_ass_id  
                                                                                       FROM posts
                                                                                       INNER JOIN users u 
                                                                                       ON posts.user_id = u.id
                                                                                       INNER JOIN categories c 
                                                                                       ON posts.category_id = c.id
                                                                                       INNER JOIN comments c2 
                                                                                       ON posts.id = c2.post_id
                                                                                       INNER JOIN images i 
                                                                                       ON posts.id = i.post_id
                                                                                       ORDER BY post DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->post.'</td>
                                                <td title="Titre">'.$mod->post_title .'</td> 
                                                <td title="Contenu">'.htmlspecialchars_decode($mod->post_content) .'</td>
                                                <td title="Avatar"><img class="img-fluid" src="'.$mod->url = str_replace('../../', '../', $mod->url).'" alt="'.$mod->post_title .'" title="'.$mod->post_title .'"></td>
                                                <td title="'.$mod->cat_desc.'">'.$mod->cat_title.'</td>
                                                <td title="Posté par">'.$mod->first_name.' '.$mod->last_name.'</td>
                                                <td title="Commentaires">'.htmlspecialchars_decode($mod->cmt_content).'</td>
                                                <td title="Tags"></td>
                                                <td title="Posté le">'.date('d/m/Y H:i:s', strtotime($mod->post_created)).'</td> 
                                                <td title="Mise à jour">'. date('d/m/Y H:i:s', strtotime($mod->post_updated)).'</td>  
                                                <td title="Modifier" class="text-center"><a href="body.php?id='.$_GET['id'].'&updateArticle='.$mod->post.'"><i class="fas fa-fw fa-history"></i> </a></td>
                                                <td title="Supprimer" class="text-center"><a href="body.php?id='.$_GET['id'].'&delArticle='.$mod->post.'" onclick="deleteArticle('.$mod->post.'); return false;"><i class="fas fa-fw fa-trash"></i></a></td>
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
                        <script>

                            function deleteArticle(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer cet article ?")){
                                    console.log('suppression effectué avec succès');

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delArticle="+ element);
                                    }, 1000);


                                }else {
                                    console.log('suppression annulé');
                                }
                            }

                        </script>
                <?php
                } //contact
                else if($_GET['id'] == 10){
                    ?>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Border Left Utilities -->
                        <div class="col-lg-12">
                            <?php
                            if(isset($_GET['updateN'])){
                                foreach (App::getDB()->query('SELECT * FROM newsletters WHERE id='.$_GET['updateN']) AS $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier Newsletter</h1>
                                    <div id="rapportN" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_new" role="form"
                                          action="controllers/traitement.php?updateN=update" method="post">
                                        <input type="hidden" name="modID" value="<?=$mod->id;?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="lbl" id="lbl"
                                                   aria-describedby="lbl" placeholder="Newsletter*" value="<?=$mod->email_newsletter;?>">
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
                                $result = App::getDB()->rowCount('SELECT id FROM newsletters');

                                // Si une erreur survient
                                if($result == 0 ) {
                                    echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste de newsletter est vide</p>
                            </div>';
                                }
                                else {
                                    ?>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste des newsletters</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_module" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM newsletters ORDER BY id DESC') AS $mod):

                                                        echo '<tr>
                                                <td title="ID">#'.$mod->id.'</td>
                                                <td title="Libelle">'.$mod->email_newsletter.'</td> 
                                                <td title="Modifier"><a href="body.php?id='.$_GET['id'].'&updateN='.$mod->id.'">Modifier</a></td>
                                                <td title="Supprimer"><a href="body.php?id='.$_GET['id'].'&delN='.$mod->id.'" onclick="deleteN('.$mod->id.'); return false;">Supprimer</a></td>
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
                            function deleteN(element){
                                if(confirm("Êtes-vous sur de vouloir supprimer ce mail?")){
                                    console.log('suppression effectué avec succès');

                                    setTimeout(function () {
                                        $(location).attr('href',"controllers/traitement.php?delN="+ element);
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

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="wysibb/src/js/wysiwyg.js"></script>
    <script src="wysibb/src/js/highlight.js"></script>

    <script src="controllers/traitement.js"></script>
</body>

</html>

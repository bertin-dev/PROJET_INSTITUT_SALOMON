<?php
require '../app/config/Config_Server.php';
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

                } //Blog
                else if($_GET['id'] == 8){

                } //contact
                else if($_GET['id'] == 10){

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

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

<?php require 'required_js.php';?>

</body>

</html>

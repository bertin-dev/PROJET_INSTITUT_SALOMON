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

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
          </div>

          <!-- Content Row -->
          <div class="row">
              <div class="col-xl-12 col-md-12">
                  <h5>Formations</h5>
              </div>
            <!-- Earnings (Monthly) Card Example -->
              <?php
              $requet = 'SELECT f.id, f.libelle AS f_lbl, f.description, f.prix, f.etat, f.frequence_paiement_id, f.module_id, f.img_url, f.headers_id, f.created_at, f.updated_at, 
             m.id AS m_id, m.libelle AS m_lbl, m.description, m.frequence_paiement_id, m.prix, m.duree, m.created_at, m.updated_at 
             FROM formation f INNER JOIN module m ON f.module_id = m.id';

              foreach($connexion->query($requet . ' GROUP BY m_id ORDER BY f.id DESC') as $retour):
                  echo '<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">'.$retour->m_lbl.'</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">'.$connexion->rowCount($requet . ' WHERE module_id='.$retour->m_id).'</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
              endforeach;
              ?>
              <br>

              <div class="col-xl-12 col-md-12">
                  <h5>Compteur des publications par catégorie</h5>
              </div>
            <!-- Earnings (Monthly) Card Example -->
              <?php
              $requet = 'SELECT * FROM categories';

              foreach($connexion->query($requet . ' ORDER BY id DESC') as $retour):
              echo '<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">'.$retour->title.'</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">'.$connexion->rowCount('SELECT * FROM posts 
                                                            INNER JOIN categories
                                                            ON categories.id=posts.category_id
                                                            WHERE categories.id='.$retour->id).'</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
              endforeach;
              ?>
              <br>

              <div class="col-xl-12 col-md-12">
                  <h5>Compteur des commentaires par publication</h5>
              </div>
              <!-- Earnings (Monthly) Card Example -->
              <?php
              $requet = 'SELECT DISTINCT title, p.id AS p_postID FROM comments c INNER JOIN posts p ON c.post_id = p.id';

              foreach($connexion->query($requet . ' ORDER BY p.id DESC') as $retour):
                  echo '<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">'.$retour->title.'</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">'.$connexion->rowCount('SELECT * FROM comments c INNER JOIN posts p ON c.post_id = p.id WHERE p.id='.$retour->p_postID).'</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
              endforeach;
              ?>
          </div>

          <!-- Content Row -->

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

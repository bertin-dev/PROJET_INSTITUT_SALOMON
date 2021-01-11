<?php require_once('page_number.php'); ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- 404 Error Text -->
          <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page Introuvable</p>
            <p class="text-gray-500 mb-0">S'il vous plait veuillez retourner à la page d'accueil auxquels cas vous serez redirigé de manière automatique après 30s. Merci</p>
            <a href="index.php">&larr; Retour</a>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white" style="margin-top: 100px">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
              &copy; Copyright <strong><span><?php  echo date("Y", time()); ?></span></strong>. All Rights Reserved
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->


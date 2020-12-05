<?php require_once('page_number.php'); ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?= isset($_ENV['description']) ? $_ENV['description']:''; ?></h2>
          <ol>
            <li><a href="home.php">Home</a></li>
            <li><?= isset($_ENV['titre']) ? $_ENV['titre']:''; ?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->


      <!-- ======= Features Section ======= -->
      <section id="features" class="features features2">
          <div class="container">

              <div class="section-title2">
                  <h2>Programmes</h2>
                  <p>Associatifs</p>
              </div>

              <div class="row">
                  <div class="col-lg-3">
                      <ul class="nav nav-tabs flex-column">
                          <?php
                          $connexion = \App::getDB();
                          foreach ($connexion->query('SELECT id, libelle, description FROM vie_ass
                                                      WHERE headers_id='.$_ENV['id_page']) as $retour):
                              echo '<li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#tab-'.$retour->id.'">'.$retour->libelle.'</a>
                          </li>';
                          endforeach;
                          ?>
                      </ul>
                  </div>
                  <div class="col-lg-9 mt-4 mt-lg-0">
                      <div class="tab-content">
                          <?php
                          foreach ($connexion->query('SELECT id, libelle, description, img_url FROM vie_ass
                                                      WHERE headers_id='.$_ENV['id_page']) as $retour):
                              $img = isset($retour->img_url) ? str_replace('../../public/', ' ', $retour->img_url) : '';
                          echo '<div class="tab-pane" id="tab-'.$retour->id.'">
                              <div class="row">
                                  <div class="col-lg-8 details order-2 order-lg-1">
                                      <h3>'.$retour->libelle.'</h3>
                                      <p>'.$retour->description.'</p>
                                  </div>
                                  <div class="col-lg-4 text-center order-1 order-lg-2">
                                      <img src="'.$img.'" alt="'.$retour->libelle.'" title="'.$retour->libelle.'" class="img-fluid">
                                  </div>
                              </div>
                          </div>';
                          endforeach;
                          ?>
                      </div>
                  </div>
              </div>

          </div>
      </section><!-- End Features Section -->

  </main><!-- End #main -->

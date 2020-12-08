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
      <section id="features" class="features">
          <div class="container">

              <div class="section-title" data-aos="fade-up">
                  <h4>Cours d’anglais Intensifs tout le long de l’année.</h4>
                  <p><strong>(gratuit pour les étudiants)</strong></p>
              </div>

              <div class="section-title2">
                  <h2><?= isset($_ENV['description']) ? $_ENV['description']:''; ?></h2>
                  <p>gratuit pour les étudiants</p>
              </div>

              <div class="row">
                  <div class="col-lg-7 ml-auto" data-aos="fade-left" data-aos-delay="100">
                      <div class="tab-content">
                          <?php
                          $connexion = \App::getDB();
                          foreach ($connexion->query('SELECT id, libelle, img_url FROM langues') as $retour):
                              $img = isset($retour->img_url) ? str_replace('../../public/', ' ', $retour->img_url) : '';
                              echo '<div class="tab-pane" id="tab-'.$retour->id.'">
                              <figure>
                                  <img src="'.$img.'" alt="'.$retour->libelle.'" title="'.$retour->libelle.'" class="img-fluid">
                              </figure>
                          </div>
                          ';

                          endforeach;
                          ?>
                          <!--<div class="tab-pane active show" id="tab-1">
                              <figure>
                                  <img src="assets/img/features-1.png" alt="" class="img-fluid">
                              </figure>
                          </div>
                          <div class="tab-pane" id="tab-2">
                              <figure>
                                  <img src="assets/img/features-2.png" alt="" class="img-fluid">
                              </figure>
                          </div>
                          <div class="tab-pane" id="tab-3">
                              <figure>
                                  <img src="assets/img/features-3.png" alt="" class="img-fluid">
                              </figure>
                          </div>
                          <div class="tab-pane" id="tab-4">
                              <figure>
                                  <img src="assets/img/features-4.png" alt="" class="img-fluid">
                              </figure>
                          </div>-->
                      </div>
                  </div>
                  <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-right">
                      <ul class="nav nav-tabs flex-column">
                          <?php
                          foreach ($connexion->query('SELECT id, libelle, description FROM langues') as $retour):

                              echo '<li class="nav-item mt-2">
                              <a class="nav-link" data-toggle="tab" href="#tab-'.$retour->id.'">
                                  <h4>'.$retour->libelle.'</h4>
                                  <p>'.$retour->description.'</p>
                              </a>
                          </li>';

                          endforeach;
                          ?>
                      </ul>
                  </div>
              </div>

          </div>
      </section><!-- End Features Section -->

  </main><!-- End #main -->

<?php require_once('page_number.php');?>

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


      <!-- ======= Programmes de formation ======= -->
    <section id="pricing" class="pricing" style="padding-top: 10px;padding-bottom: 10px">
          <div class="container">

              <div class="section-title2">
                  <h2><?= isset($_ENV['titre']) ? $_ENV['titre']:''; ?></h2>
                  <p>de formations</p>
              </div>
              <div class="row">


                  <?php
                  $connexion = \App::getDB();
                  foreach($connexion->query('SELECT formation.id, formation.libelle AS fLbl, formation.description AS fDesc, 
                                                             formation.prix AS fPrix, formation.etat AS fEtat, formation.frequence_paiement_id, formation.module_id, 
                                                             formation.img_url AS fImg_url, formation.headers_id, formation.created_at, 
                                                             formation.updated_at, fp.id, fp.libelle AS fpLbl, m.id AS mod_id, m.libelle AS mLbl, 
                                                             m.description AS mDesc, m.frequence_paiement_id, m.prix AS mPrix, m.duree AS mDuree, m.created_at AS m_create,
                                                             m.updated_at
                                                      FROM formation
                                                      INNER JOIN frequence_paiement fp 
                                                      ON fp.id = formation.frequence_paiement_id
                                                      INNER JOIN module m 
                                                      ON formation.module_id = m.id
                                                      GROUP BY formation.module_id
                                                      ORDER BY m.id DESC 
                                                      ') as $retour):

            echo ' <div class="accordion col-lg-6" id="accordionExample'.$retour->mod_id.'" data-aos="fade-up">

                          <div class="card">
                              <div class="card-header" id="heading'.$retour->mod_id.'">
                                  <h2 class="mb-0">
                                      <button style="color: rgb(138, 43, 226); font-weight: bold" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'.$retour->mod_id.'" aria-expanded="true" aria-controls="collapse'.$retour->mod_id.'" title="'.$retour->mDesc.'">
                                      <i class="bx bx-chevron-down"></i>
                                       '.strtoupper($retour->mLbl).'
                                      </button>
                                  </h2>
                              </div>

                              <div data-aos="fade-right" style="background: #8A2BE2;" id="collapse'.$retour->mod_id.'" class="collapse show" aria-labelledby="heading'.$retour->mod_id.'" data-parent="#accordionExample'.$retour->mod_id.'">
                                  <div class="card-body">
                                  
                                       <ul style="color: white">';

                      foreach($connexion->query('SELECT f.id, f.libelle AS flibelle, f.description AS fdecription, f.prix, f.etat, f.frequence_paiement_id, f.module_id, f.img_url, f.headers_id, f.created_at, f.updated_at,
                                                             m.id, m.libelle, m.description, m.frequence_paiement_id, m.prix, m.duree, m.created_at, m.updated_at
                                                      FROM formation f
                                                      INNER JOIN module m 
                                                      ON f.module_id = m.id
                                                      WHERE f.module_id ='.$retour->mod_id.'
                                                      ORDER BY f.id DESC 
                                                      ') as $list):

                          echo '<li title="'.$list->fdecription.'">'.$list->flibelle.'</li>';
                      endforeach;

                      echo '</ul>
                                  </div>
                              </div>
                          </div>
                         
                 

                  </div>';
                  endforeach;
            ?>
              </div>

          </div>
      </section><!-- End Pricing Section -->


  </main><!-- End #main -->


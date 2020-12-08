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
                                                             formation.updated_at, fp.id, fp.libelle AS fpLbl, m.id, m.libelle AS mLbl, 
                                                             m.description AS mDesc, m.frequence_paiement_id, m.prix AS mPrix, m.duree AS mDuree, m.created_at,
                                                             m.updated_at 
                                                      FROM formation
                                                      INNER JOIN frequence_paiement fp 
                                                      ON fp.id = formation.frequence_paiement_id
                                                      INNER JOIN module m 
                                                      ON formation.module_id = m.id
                                                      ') as $retour):
                       //WHERE headers_id='.$_ENV['id_page']
                      echo '<div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                          <div class="col-8 offset-2 text-center pf" data-aos="fade-up">
                          <h3 style="margin-bottom: initial;" title="'.$retour->mDesc.'">'.$retour->mLbl.'</h3></div>
                      <div class="box" data-aos="fade-right" style="border-radius: 58px;">
                          <h4>'.$retour->mPrix.'<sub>Fcfa</sub><span> / ';
                  if(intval($retour->mDuree)==0)
                      echo '';
                  else
                      echo $retour->mDuree;

                      echo ' '.$retour->fpLbl.'</span></h4>
                          <ul>
                              <li title="'.$retour->fDesc.'">'.$retour->fLbl.'</li>
                          </ul>
                          <!--<div class="btn-wrap">
                              <a href="#" class="btn-buy">Buy Now</a>
                          </div>-->
                      </div>
                  </div>';
                  endforeach;
                  ?>
              </div>

          </div>
      </section><!-- End Pricing Section -->


  </main><!-- End #main -->


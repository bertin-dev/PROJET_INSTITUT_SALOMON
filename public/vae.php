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

    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
        <div class="container">

            <div class="row no-gutters">
                <?php
                $connexion = \App::getDB();
                foreach ($connexion->query('SELECT img_url FROM vae
                                                      WHERE vae_etat ="0" LIMIT 1') as $retour):
                $img = isset($retour->img_url) ? str_replace('../../public/', ' ', $retour->img_url) : '';
                echo '
                <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start" data-aos="fade-right" style="background-image: url('.$img.');"></div>';
                endforeach;
                ?>
                <div class="col-xl-7 pl-0 pl-lg-5 pr-lg-1 d-flex align-items-stretch">
                    <div class="content d-flex flex-column justify-content-center">

                        <?php
                        foreach ($connexion->query('SELECT libelle, description FROM vae
                                                      WHERE vae_etat ="0"') as $retour):
                        echo '<h3 data-aos="fade-up">'.$retour->libelle.'</h3>
                        <p data-aos="fade-up">'.$retour->description.'</p>';
                        endforeach;
                        ?>
                        <h3 class="d-flex flex-column justify-content-center">Eléments à fournir: </h3>
                        <div class="row">
                            <?php
                            $i = 100;
                            foreach ($connexion->query('SELECT libelle, description FROM vae
                                                      WHERE vae_etat ="1"') as $retour):
                                echo '<div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="'.$i.'">
                                <i class="bx bx-cube-alt"></i>
                                <h4>'.$retour->libelle.'</h4>
                                <p>'.$retour->description.'</p>
                                     </div>';
                            $i+=100;
                            endforeach;
                            ?>
                            <!--<div class="col-md-6 icon-box" data-aos="fade-up">
                                <i class="bx bx-receipt"></i>
                                <h4>Lettre de motivation</h4>
                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                <i class="bx bx-cube-alt"></i>
                                <h4>CV actualisé </h4>
                                <p>avec des références/personnes à contacter au besoin</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                <i class="bx bx-images"></i>
                                <h4>Scan du diplôme le plus élevé</h4>
                                <p>et des diplômes inférieurs, jusqu’au Baccalauréat</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                <i class="bx bx-shield"></i>
                                <h4>Remplir la fiche d’inscription</h4>
                                <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                <i class="bx bx-shield"></i>
                                <h4>Payer les frais d’inscription+ frais de la scolarité</h4>
                                <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                <i class="bx bx-shield"></i>
                                <h4>Durée du processus : 4 semaines</h4>
                                <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                            </div>-->
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->

  </main><!-- End #main -->


<?php
require_once('page_number.php');
?>


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


    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title2">
                <h2><?= isset($_ENV['titre']) ? $_ENV['titre']:''; ?></h2>
                <p><?= isset($_ENV['description']) ? $_ENV['description']:''; ?></p>
            </div>
            <div class="row">
                <?php
                $connexion = \App::getDB();
                foreach($connexion->query('SELECT * FROM about') as $retour):
                    $img = !empty($retour->img_url) ? str_replace('../../public/', ' ', $retour->img_url): 'assets/img/about.jpg';

                echo '<div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="'.$img.'" class="img-fluid" alt="'.$retour->libelle.'" title="'.$retour->libelle.'">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <h3>'.$retour->libelle.'</h3>
                    <p>
                        '.$retour->description.'
                    </p>

                </div>';
                endforeach;
                ?>
            </div>

        </div>
    </section><!-- End About Section -->




</main>

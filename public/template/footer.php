<footer id="footer">

    <div class="footer-top" style="padding-bottom: initial">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Institut salomon</h4>
                    <?php
                    $connexion = App::getDB();
                    foreach($connexion->query('SELECT phone, localisation, web_site, email, h_ouverture, h_fermeture FROM footer') as $retour):
                        echo '<p>'.$retour->localisation.'<br>
                              <strong>Tel: </strong> '.$retour->phone.'<br>
                                <strong>Email: </strong> '.$retour->email.'<br>
                                <strong>Web: </strong> '.$retour->web_site.'<br>
                                <strong> '.$retour->h_ouverture.' à '.$retour->h_fermeture.'</strong><br>
                             </p>';
                    endforeach;
                    ?>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h4>Photos Galerie Intitut Salomon</h4>
                    <div class="row align-items-center">
                        <div class="col-lg-12" id="slider">
                            <div id="myCarousel" class="carousel slide shadow" data-ride="carousel">
                                <!-- main slider carousel items -->
                                <div class="carousel-inner">

                                    <?php
                                    foreach($connexion->query('SELECT id, url_miniature, url FROM images') as $retour):

                                        $img = isset($retour->url) ? str_replace('../../public/', ' ', $retour->url): 'assets/img/slide/slide-1.jpg';

                                        echo ' <div class="carousel-item" data-slide-number="'.$retour->id.'">
                                          <img src="'.$img.'" class="img-fluid">
                                                </div>';
                                    endforeach;
                                    ?>

                                </div>
                                <!-- main slider carousel nav controls -->


                                <ul class="carousel-indicators list-inline mx-auto border px-2">
                                    <?php
                                    foreach($connexion->query('SELECT id, url_miniature, url FROM images') as $retour):

                                        $img_miniature = isset($retour->url_miniature) ? str_replace('../../public/', ' ', $retour->url_miniature): 'assets/img/slide/slide-1.jpg';

                                        echo '<li class="list-inline-item">
                                          <a id="carousel-selector-'.$retour->id.'" data-slide-to="'.$retour->id.'" data-target="#myCarousel">
                                              <img src="'.$img_miniature.'" class="img-fluid">
                                          </a>
                                            </li>';
                                    endforeach;
                                    ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links" style="margin-bottom: initial">
                    <h4>Espace Membre</h4>
                    <ul>
                        <?php
                        $connexion = App::getDB();
                        foreach($connexion->query('SELECT * FROM categories LIMIT 6') as $retour):
                            ?>
                        <li><i class="bx bx-chevron-right"></i><a class="categorie_footer" href="index.php?id_page=8&categories=<?=$retour->id;?>" data="<?=$retour->id;?>"><?=$retour->title;?>
                                <?php
                                $result = App::getDB()->rowCount('SELECT * FROM posts 
                                                            INNER JOIN categories
                                                            ON categories.id=posts.category_id
                                                            WHERE categories.id='.$retour->id);
                                echo '<span>('.$result.')</span></a></li>';

                        endforeach;
                        ?>
                        <li><i class="bx bx-chevron-right"></i> <a href="index.php?id_page=8">Blog</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#" data-toggle="modal" data-target="#login">Login</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-newsletter">
                    <h4>NEWSLETTER</h4>
                    <p>Pour recevoir des informations de l'institut salomon, veuillez nous envoyer votre adresse email</p>
                    <div class="alert alert-danger rapport_newsletter" style="display:none;"></div>
                    <form id="newsletters" method="post" onsubmit="return false;">
                        <input class="form-control" type="email" placeholder="email@domaine.com" required
                               title="Entrez votre Email" name="newsletter" id="newsletter"/>
                        <small id="output_newsletter"></small>
                        <input id="enreg_newsletter" type="submit" value="Envoyer">
                        <div id="load_data_newsletter" class="validate"></div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4" style="padding-top: initial!important;">

        <div class="mr-md-auto text-center text-md-left">
            <div class="copyright">
                &copy; Copyright <strong><span><?php  echo date("Y", time()); ?></span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/ -->
                Designed by <span>SALOMON INSTITUT</span>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="<?= isset($_ENV['url_twitter']) ? $_ENV['url_twitter']:'#'; ?>" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="<?= isset($_ENV['url_facebook']) ? $_ENV['url_facebook']:'#'; ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="<?= isset($_ENV['url_skype']) ? $_ENV['url_skype']:'#'; ?>" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="<?= isset($_ENV['url_linkedin']) ? $_ENV['url_linkedin']:'#'; ?>" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
<div id="preloader"></div>

<!-- Vendor JS Files -->

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<script src="assets/js/jquery.timego.js"></script>
<script>
    // French
    jQuery.timeago.settings.strings = {
        // environ ~= about, it's optional
        prefixAgo: "il y a",
        prefixFromNow: "d'ici",
        seconds: "moins d'une minute",
        minute: "une minute",
        minutes: "%d minutes",
        hour: "une heure",
        hours: "%d heures",
        day: "un jour",
        days: "%d jours",
        month: "un mois",
        months: "%d mois",
        year: "un an",
        years: "%d ans"
    };


    jQuery(document).ready(function() {
        $("time.timeago").timeago();
    });
</script>




<!-- Login-->
<div class="modal fade" id="login" tabindex="-1" role="application" aria-labelledby="login"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div id="rapportLogin" class="alert alert-danger" style="display:none;"></div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenue!</h1>
                                    </div>
                                    <form class="user" id="singIn" method="post" onsubmit="return false;">
                                        <div id="SingInForm">
                                            <div class="form-group">
                                                <input type="email" name="email" required class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Adresse Email">
                                                <small id="output_emailSingIn"></small>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" required class="form-control form-control-user" id="exampleInputPassword" placeholder="Mot de passe">
                                                <small id="output_passwordSingIn"></small>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" name="t_and_c" value="1" class="custom-control-input" id="t_and_c">
                                                    <label class="custom-control-label" for="t_and_c">Se souvenir</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button id="login_send" class="btn btn-primary btn-user btn-block" type="submit" style="background: #8A2BE2">Login</button>
                                                <center><img id="load_data_SingIn" src="assets/img/loader.gif" class="loader" style="display:none;"></center>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="#" data-toggle="modal" data-target="#forgot-password">Mot de passe oublié?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- forgot password-->
<div class="modal fade" id="forgot-password" tabindex="-1" role="application" aria-labelledby="forgot-password"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mot de passe oublié</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div id="rapportPwdF" class="alert alert-danger" style="display:none;"></div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Mot de passe oublié?</h1>
                                        <p class="mb-4">Entrez simplement votre adresse e-mail ci-dessous et nous vous enverrons votre mot de passe!</p>
                                    </div>
                                    <form class="user" id="getPassword" method="post" onsubmit="return false;">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="emailForget" id="emailForget" aria-describedby="emailHelp" placeholder="Entrer Adresse Email">
                                            <em><small id="output_getEmail"></small></em>
                                        </div>
                                        <div class="form-group">
                                            <button id="sendEmailForget" type="submit" class="btn btn-primary btn-user btn-block" style="background: #8A2BE2">Envoyer</button>
                                            <center><img id="load_data_getEmail" src="assets/img/loader.gif" class="loader" style="display:none;"></center>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
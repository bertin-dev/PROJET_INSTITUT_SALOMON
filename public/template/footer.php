
<footer id="footer">

    <div class="footer-top" style="padding-bottom: initial">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Contact</h3>
                    <p><?= isset($_ENV['localisation']) ? $_ENV['localisation']:''; ?><br>
                        <!--New York, NY 535022<br>-->
                        <!--United States <br><br>-->
                        <strong>Phone:</strong> <?= isset($_ENV['phone']) ? $_ENV['phone']:''; ?><br>
                        <strong>Email:</strong> <?= isset($_ENV['email']) ? $_ENV['email']:''; ?><br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links" style="margin-bottom: initial">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links" style="margin-bottom: initial">
                    <h4>Derniers Articles</h4>
                    <div class="" style="margin-bottom: 30px;">
                        <?php
                        foreach (App::getDB()->query('SELECT posts.id AS id_posts, title, content, post_type, likes, dislike, favourited, posts.created_at,
                                                            user_id, category_id, images.id AS id_images, url_miniature, url FROM posts
                                                     INNER JOIN images
                                                     ON posts.id=images.post_id
                                                     ORDER BY posts.id DESC LIMIT 3') AS $recent_post):

                            echo '<div class="post-item clearfix">
            <img style="width: 80px;float: left; margin-bottom: 10px" class="img-responsive img-thumbnail" src="'.str_replace('../../public/', '', $recent_post->url).'" alt="'.$recent_post->title.'" title="'.$recent_post->title.'">
            <h4 style="font-size: 15px;margin-left: 95px;font-weight: bold; padding-bottom: initial"><a style="color: white;transition: 0.3s;" onclick="return false;" title="'.$recent_post->title.'" href="#">'.strtolower($recent_post->title).'</a></h4>
            <time style="display: block;margin-left: 95px;font-style: italic;font-size: 14px;color: #9c847b;" datetime="2020-01-01">'.date('F j, Y', strtotime($recent_post->created_at)).'</time>
        </div>';
                        endforeach;
                        ?>

                    </div><!-- End sidebar recent posts-->
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Join Our Newsletter</h4>
                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
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
                Designed by <a href="https://bertin-mounok.com/">bertin.dev, Inc.</a>
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
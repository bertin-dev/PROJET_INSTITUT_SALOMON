
<section id="topbar" class="d-none d-lg-block">
    <div class="container d-flex">
        <div class="contact-info mr-auto">
            <i class="icofont-envelope"></i><a href="mailto:<?= isset($_ENV['email']) ? $_ENV['email']:''; ?>"><?= isset($_ENV['email']) ? $_ENV['email']:''; ?></a>
            <i class="icofont-phone"></i> <?= isset($_ENV['phone']) ? $_ENV['phone']:''; ?>
        </div>
        <div class="social-links">
            <a href="<?= isset($_ENV['url_twitter']) ? $_ENV['url_twitter']:'#'; ?>" class="twitter"><i class="icofont-twitter"></i></a>
            <a href="<?= isset($_ENV['url_facebook']) ? $_ENV['url_facebook']:'#'; ?>" class="facebook"><i class="icofont-facebook"></i></a>
            <a href="<?= isset($_ENV['url_skype']) ? $_ENV['url_skype']:'#'; ?>" class="skype"><i class="icofont-skype"></i></a>
            <a href="<?= isset($_ENV['url_linkedin']) ? $_ENV['url_linkedin']:'#'; ?>" class="linkedin"><i class="icofont-linkedin"></i></i></a>
            <a href="http://www.youtube.com" class="youtube"><i class="bx bxl-youtube"></i></a>
            <a href="http://www.instagram.com" class="instagram"><i class="bx bxl-instagram"></i></a>
        </div>
    </div>
</section>
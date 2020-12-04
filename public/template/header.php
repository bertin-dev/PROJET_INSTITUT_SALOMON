
<header id="header">
    <div class="container d-flex">

        <div class="logo mr-auto">
            <img style="" class="img-profile"
                 alt="<?= isset($_ENV['nom_site']) ? $_ENV['nom_site']:''; ?>" src="<?= isset($_ENV['logo']) ? str_replace('../../public/', ' ', $_ENV['logo']): 'assets/img/about.jpg'; ?>" title="<?= isset($_ENV['slogan']) ? $_ENV['slogan']:''; ?>"/>
            <span class="top-bar-colors" title="<?= isset($_ENV['slogan']) ? $_ENV['slogan']:''; ?>"
                  style="font-size: 9px; position: relative; top: 17px;"><?= isset($_ENV['nom_site']) ? $_ENV['nom_site']:''; ?></span>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <?= core\controller\Controller::affiche_menu($id_page_accueil); ?>

    </div>
</header>

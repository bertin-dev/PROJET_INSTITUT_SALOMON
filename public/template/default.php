<!DOCTYPE html>
<html lang="<?= isset($_ENV['lang']) ? $_ENV['lang']:''; ?>">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Insère le titre extrait de la DB dans la balise correspondante -->
    <title><?php if(isset($_ENV['titre']) && intval($_ENV['id_home'])==1) echo $_ENV['nom_site'] .' | '.$_ENV['titre'];
        else if(isset($_ENV['titre'])) echo $_ENV['titre'].' | '. $_ENV['nom_site'];
        else echo 'Page N°'.$_ENV['id_page'].' Introuvable'; ?></title>

    <link rel="canonical" href="<?= isset($_ENV['url']) ? $_ENV['url']: '';?>">
    <link rel="<?= isset($_ENV['url']) ? $_ENV['titre']: '';?>" href="<?= isset($_ENV['url']) ? $_ENV['url']: '';?>">


    <meta lang="<?= isset($_ENV['lang']) ? $_ENV['lang']:''; ?>" content="<?= isset($_ENV['description']) ? $_ENV['description']:''; ?>" name="description">
    <meta lang="<?= isset($_ENV['lang']) ? $_ENV['lang']:''; ?>" content="<?= isset($_ENV['mots_cles']) ? $_ENV['mots_cles']:''; ?>" name="keywords">
    <meta name="author" content="Bertin Mounok, Bertin-Mounok, Pipo Ndemba, Supers-Pipo, bertin.dev, bertin-dev, Ngando Mounok Hugues Bertin">
    <meta name="copyright" content="© <?=date('Y', time());?>, bertin.dev, Inc.">
    <meta name="language" content="<?= isset($_ENV['lang']) ? $_ENV['lang']:''; ?>">
    <!-- Redirection vers une autre URL au bout de 60 secondes -->
    <?php if(!isset($_ENV['titre'])){
        echo '<meta http-equiv="refresh" content="30;url=index.php"';
    }?>

    <!-- Icône du site (favicon) -->
    <link rel="icon" type="image/png" href="<?= isset($_ENV['icon']) ? $_ENV['icon'] = str_replace('../../public/', ' ', $_ENV['icon']):'assets/img/about.jpg'; ?>"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
/* ------------------------------------------------------------------------
    Auteur: Bertin Mounok (https://www.bertin-mounok.com)
    Version: 1.0.0
    Foncton: inclus l' entête, le corps et le pied de page
------------------------------------------------------------------------- */
    ======================================================== -->
</head>

<body>

<!-- ======= Top Bar ======= -->
<?php include('topbar.php');?>
<!-- End Top Bar -->


<!-- ======= Header ======= -->
<?php include('header.php');?>
<!-- End Header -->

<?= $contenu; ?>

<!-- ======= Footer ======= -->
<?php include('footer.php'); ?>
<!-- End Footer -->

</body>

</html>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <!--<i class="fas fa-laugh-wink"></i>-->
            <img src="img/logo.png" alt="" width="40">
        </div>
        <div class="sidebar-brand-text mx-3">IS <sup>Newlook</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de Bord</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        HEADER
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-list"></i>
            <span> En tête</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Add Header: </h6>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#msg">Message d'accueil</a>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#logo_icone">Titre du site</a>
                <div class="collapse-divider"></div>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#menu_modal">Menu du site</a>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#slide">Slides</a>
                <a class="collapse-item" href="list.php?id=1">Détails</a>
            </div>
        </div>
    </li>


    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        BODY
    </div>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-list"></i>
            <span>Onglets</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Add Body</h6>
                <?php
                $connexion = \App::getDB();
                foreach($connexion->query('SELECT page.id AS id, headers.id AS myHeaders, titre, description, parent_id FROM page
                INNER JOIN headers
                ON page.headers_id=headers.id') as $retour):
                    if($retour->id==1 OR $retour->id>=6)
                    echo '<a title="'.$retour->description.'" class="collapse-item" href="body.php?id='.$retour->myHeaders.'">'.$retour->titre.'</a>';
                endforeach;
                ?>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Footer
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFooter" aria-expanded="true" aria-controls="collapseFooter">
            <i class="fas fa-fw fa-cog"></i>
            <span> Pied de Page</span>
        </a>
        <div id="collapseFooter" class="collapse" aria-labelledby="headingFooter" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Add Footer: </h6>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#sous_menu_modal">Pied de page</a>
                <div class="collapse-divider"></div>
                <a class="collapse-item" href="list.php?id=2">Détails</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
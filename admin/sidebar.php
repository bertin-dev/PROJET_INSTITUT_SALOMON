<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
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
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span> En tête</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Identité du site: </h6>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#logo_icone">Titre du site</a>
                <div class="collapse-divider"></div>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#menu_modal">Menu du site</a>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#sous_menu_modal">Pied de page</a>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#slide">Slides</a>
                <a class="collapse-item" href="buttons.html">Slogan</a>
                <a class="collapse-item" href="list_posts.php">Icône du site</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFooter" aria-expanded="true" aria-controls="collapseFooter">
            <i class="fas fa-fw fa-cog"></i>
            <span> Pied de Page</span>
        </a>
        <div id="collapseFooter" class="collapse" aria-labelledby="headingFooter" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Liste des Blocs: </h6>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#footer_b1">Bloc 1</a>
                <div class="collapse-divider"></div>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#footer_b2">Bloc 2</a>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#footer_b3">Bloc 3</a>
            </div>
        </div>
    </li>




    <!-- FORUM d'échange -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForum" aria-expanded="true" aria-controls="collapseForum">
            <i class="fas fa-fw fa-plus"></i>
            <span> Actualité de l'entreprise</span>
        </a>
        <div id="collapseForum" class="collapse" aria-labelledby="headingFooter" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Modules </h6>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#caterories">Catégories</a>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#tag">Tags</a>
                <div class="collapse-divider"></div>
                <a class="collapse-item" href="article.php">Posté un article</a>
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#footer_b3">Liste des Postes</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-list"></i>
            <span>Onglets</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Disponibles</h6>
                <?php
                $connexion = \App::getDB();
                foreach($connexion->query('SELECT page.id AS id, headers.id AS myHeaders, titre, description, parent_id FROM page
                INNER JOIN headers
                ON page.headers_id=headers.id') as $retour):
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
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
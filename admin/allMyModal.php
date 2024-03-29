<!--EN TÊTE-->
<!-- logo_icone Modal-->
<div class="modal fade" id="logo_icone" tabindex="-1" role="dialog" aria-labelledby="logo_icone" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Identite du site</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="idSiteWebRapport" class="alert alert-danger"
                                             style="display:none;"></div>
                                        <form id="idSiteWeb" class="user" role="form"
                                              action="controllers/traitement.php?idSiteWeb=idSiteWeb" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="titreSiteWeb"
                                                       id="titreSiteWeb" aria-describedby="titreSiteWeb"
                                                       placeholder="Titre du site">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control" id="sloganSiteWeb"
                                                       name="sloganSiteWeb" aria-describedby="sloganSiteWeb"
                                                       placeholder="Slogan du site">
                                            </div>

                                            <div class="form-group">
                                                <input type="url" class="form-control" id="fbSiteWeb" name="fbSiteWeb"
                                                       value="https://www.facebook.com" aria-describedby="fbSiteWeb"
                                                       placeholder="Url Facebook">
                                            </div>

                                            <div class="form-group">
                                                <input type="url" class="form-control" id="twitterSiteWeb"
                                                       value="https://www.twitter.com" name="twitterSiteWeb"
                                                       aria-describedby="twitterSiteWeb" placeholder="Url Twitter">
                                            </div>

                                            <div class="form-group">
                                                <input type="url" class="form-control" id="linkedInSiteWeb"
                                                       value="https://www.linkedin.com" name="linkedInSiteWeb"
                                                       aria-describedby="linkedInSiteWeb" placeholder="Url LinkedIn">
                                            </div>

                                            <div class="form-group">
                                                <input type="url" class="form-control" id="skypeSiteWeb"
                                                       value="https://www.skype.com" name="skypeSiteWeb"
                                                       aria-describedby="skypeSiteWeb" placeholder="Url Skype">
                                            </div>

                                            <div class="form-group">
                                                <label for="logo">Logo et Icône du site</label>
                                                <input type="file" class="form-control-file" id="logo" name="logo">
                                            </div>

                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Publier"/>
                                                <center><img src="img/loader.gif" class="siteWebUploads"
                                                             style="display:none;"></center>
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
</div>

<!-- Menu Modal du site-->
<div class="modal fade" id="menu_modal" tabindex="-1" role="application" aria-labelledby="menu_modal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">MENU DU SITE WEB</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="menuRapport" class="alert alert-danger" style="display:none;"></div>
                                <form id="form_menu" class="user" role="form"
                                      action="controllers/traitement.php?menu=menu" method="post">

                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="listmenu">Sélectionner un Menu</label>
                                        <select class="custom-select my-1 mr-sm-2" id="listmenu" name="listmenu">
                                            <option selected value="1">Menu</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="menu" id="menu"
                                               aria-describedby="menu" placeholder="Nom du menu">
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" aria-describedby="description_menu"
                                                  name="description_menu" id="description_menu" cols="10" rows="3"
                                                  placeholder="Description du Menu"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" aria-describedby="keyword" name="keyword"
                                                  id="description_menu" cols="10" rows="3"
                                                  placeholder="Mots clés du Menu"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Publier"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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

<!-- PIED DE PAGE -->
<div class="modal fade" id="sous_menu_modal" tabindex="-1" role="alertdialog" aria-labelledby="sous_menu_modal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PIED DE PAGE</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">


                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="submenuRapport" class="alert alert-danger" style="display:none;"></div>
                                        <form id="form_submenu" class="user" role="form"
                                              action="controllers/traitement.php?submenu=submenu" method="post">


                                            <div class="form-group">
                                                <label class="my-1 mr-2" for="footer_b">Sélectionner</label>
                                                <select class="custom-select my-1 mr-sm-2" id="footer_b"
                                                        name="footer_b">
                                                    <option value="1">Contact et Localisation</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control" id="tel" name="tel"
                                                       aria-describedby="tel" placeholder="Telephone">
                                                <div id="result_submenu1"></div>
                                            </div>

                                            <div class="form-group">
                                                <input type="email" class="form-control" id="email" name="email"
                                                       aria-describedby="email" placeholder="Email">
                                                <div id="result_submenu3"></div>
                                            </div>

                                            <div class="form-group">
                                                <input type="url" class="form-control" id="url" name="url"
                                                       aria-describedby="url" placeholder="Site web">
                                                <div id="result_submenu4"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="h_ouverture">Heure d'ouverture</label>
                                                <input type="time" class="form-control" id="h_ouverture" name="h_ouverture"
                                                       aria-describedby="h_ouverture" placeholder="Heure d'ouverture">
                                            </div>

                                            <div class="form-group">
                                                <label for="h_fermeture">Heure de fermeture</label>
                                                <input type="time" class="form-control" id="h_fermeture" name="h_fermeture"
                                                       aria-describedby="h_fermeture" placeholder="Heure fermeture">
                                            </div>

                                            <div class="form-group">
                                                <textarea class="form-control" aria-describedby="localisation"
                                                          name="localisation" id="localisation"
                                                          cols="5" rows="3" placeholder="Localisation"></textarea>
                                                <div id="result_submenu2"></div>
                                            </div>

                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Publier"/>
                                                <center><img src="img/loader.gif" class="loader" style="display:none;">
                                                </center>
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
</div>


<!-- SLIDES -->
<!-- logo_icone Modal-->
<div class="modal fade" id="slide" tabindex="-1" role="dialog" aria-labelledby="slide" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Caroussel</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="slideRapport" class="alert alert-danger" style="display:none;"></div>
                                        <form id="form_slide" class="user" role="form"
                                              action="controllers/traitement.php?slide=slide" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="titreSlide"
                                                       name="titreSlide" aria-describedby="titreSlide"
                                                       placeholder="Titre du Slide">
                                            </div>

                                            <div class="form-group">
                                                <textarea name="descSlide" class="form-control" id="descSlide"
                                                          aria-describedby="descSlide"
                                                          placeholder="Description du Slide" cols="30"
                                                          rows="5"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="logo">Importer une image 1024*780</label>
                                                <input type="file" class="form-control-file" id="logo" name="logo">
                                            </div>

                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Publier"/>
                                                <center><img src="img/loader.gif" class="loader" style="display:none;">
                                                </center>
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
</div>


<!-- FORUM D'ECHANGES -->
<!-- CATEGORIES-->
<div class="modal fade" id="caterories" tabindex="-1" role="dialog" aria-labelledby="caterories" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Catégories</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">

                                        <!-- Collapsable Card Example -->
                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Accordion -->
                                            <a href="#collapseAddCategories" class="d-block card-header py-3"
                                               data-toggle="collapse" role="button" aria-expanded="false"
                                               aria-controls="collapseAddCategories">
                                                <h6 class="m-0 font-weight-bold text-primary">Ajouter une catégorie</h6>
                                            </a>
                                            <!-- Card Content - Collapse -->
                                            <div class="collapse show" id="collapseAddCategories">
                                                <div class="card-body">
                                                    <div id="categoriesRapport" class="alert alert-danger"
                                                         style="display:none;"></div>
                                                    <form class="user" role="form" id="form_add_categories"
                                                          action="controllers/traitement.php?categories=add"
                                                          method="post">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                   id="titre_categories" name="titre_categories"
                                                                   aria-describedby="titre_categories"
                                                                   placeholder="Titre Catégorie">
                                                        </div>

                                                        <div class="form-group">
                                                            <textarea name="desc_categories" class="form-control"
                                                                      id="desc_categories"
                                                                      aria-describedby="desc_categories" cols="30"
                                                                      rows="5"
                                                                      placeholder="Description Catégorie"></textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="submit"
                                                                   class="btn btn-primary btn-user btn-block currentSend"
                                                                   value="Publier"/>
                                                            <center><img src="img/loader.gif" class="loader"
                                                                         style="display:none;"></center>
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
            </div>
        </div>
    </div>
</div>

<!-- TAG-->
<div class="modal fade" id="tag" tabindex="-1" role="dialog" aria-labelledby="tag" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tags</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">

                                        <!-- Collapsable Card Example -->
                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Accordion -->
                                            <a href="#collapseAddCategories" class="d-block card-header py-3"
                                               data-toggle="collapse" role="button" aria-expanded="false"
                                               aria-controls="collapseAddCategories">
                                                <h6 class="m-0 font-weight-bold text-primary">Ajouter un Tag</h6>
                                            </a>
                                            <!-- Card Content - Collapse -->
                                            <div class="collapse show" id="collapseAddCategories">
                                                <div class="card-body">
                                                    <div class="alert alert-danger rapport" style="display:none;"></div>
                                                    <form class="user" role="form" id="form_add_tag"
                                                          action="controllers/traitement.php?tag=add" method="post">
                                                        <div class="form-group">
                                                            <label for="titre_tag"></label><input type="text"
                                                                                                  class="form-control"
                                                                                                  id="titre_tag"
                                                                                                  name="titre_tag"
                                                                                                  aria-describedby="titre_tag"
                                                                                                  placeholder="Titre du Tag">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="submit"
                                                                   class="btn btn-primary btn-user btn-block currentSend"
                                                                   value="Publier"/>
                                                            <center><img src="img/loader.gif" class="loader"
                                                                         style="display:none;" alt=""></center>
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
            </div>
        </div>
    </div>
</div>



<!-- ajouter module-->
<div class="modal fade" id="module_list" tabindex="-1" role="application" aria-labelledby="module_list"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Module</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportM" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_module" role="form"
                                      action="controllers/traitement.php?module=module" method="post">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="lbl" id="lbl"
                                               aria-describedby="lbl" placeholder="Libelle*">
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" class="form-control" name="prix" id="prix"
                                               aria-describedby="prix" placeholder="Prix">
                                    </div>

                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="frequence">Fréquence de paiement</label>

                                        <select class="my-1" id="duree" name="duree">
                                            <?php
                                            for ($i = 0; $i < 50; $i++){
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <span>/</span>
                                        <select class="my-1" id="frequence" name="frequence">
                                            <?php
                                            foreach (App::getDB()->query('SELECT id, libelle FROM frequence_paiement ORDER BY id DESC') AS $frequence):
                                                echo '<option value="' . $frequence->id . '">' . $frequence->libelle . '</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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

<!-- ajouter formation-->
<div class="modal fade" id="formation_list" tabindex="-1" role="application" aria-labelledby="formation_list"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportF" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_formation" role="form"
                                      action="controllers/traitement.php?formation=formation" method="post">
                                    <input type="hidden" name="header_id" value="<?= HEADER_ID;?>">
                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="listmodule">Liste des modules</label>
                                        <select class="custom-select my-1 mr-sm-2" id="listmodule" name="listmodule">
                                            <?php
                                            foreach (App::getDB()->query('SELECT id, libelle FROM module') AS $module):
                                                echo '<option value="' . $module->id . '">' . $module->libelle . '</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="lbl" id="lbl"
                                               aria-describedby="lbl" placeholder="Libelle*">
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" class="form-control" name="prix" id="prix"
                                               aria-describedby="prix" placeholder="Prix">
                                    </div>

                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="frequence">Fréquence de paiement</label>
                                        <select class="custom-select my-1 mr-sm-2" id="frequence" name="frequence">
                                            <?php
                                            foreach (App::getDB()->query('SELECT id, libelle FROM frequence_paiement ORDER BY id DESC') AS $frequence):
                                                echo '<option value="' . $frequence->id . '">' . $frequence->libelle . '</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="etat">Etat</label>
                                        <select class="custom-select my-1 mr-sm-2" id="etat" name="etat">
                                            <option selected value="0">disponible</option>
                                            <option value="1">Indisponible</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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


<!-- ajouter equipe pedagogique-->
<div class="modal fade" id="equipeP" tabindex="-1" role="application" aria-labelledby="equipeP"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Equipe Pédagogique</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportEquipP" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_EquipP" role="form"
                                      action="controllers/traitement.php?equipeP=equipeP" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="last_name" id="nom"
                                               aria-describedby="nom" placeholder="Nom*" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="first_name" id="prenom"
                                               aria-describedby="prenom" placeholder="Prenom*" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="profession" id="profession"
                                               aria-describedby="profession" required placeholder="profession*">
                                    </div>

                                    <div class="form-group">
                                        <label for="avatar">Photo de profil</label>
                                        <input type="file" class="form-control" name="avatar" id="avatar"
                                               aria-describedby="avatar" required placeholder="avatar*">
                                    </div>


                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email"
                                               aria-describedby="email" placeholder="email">
                                    </div>


                                    <div class="form-group">
                                        <input type="url" class="form-control" name="twitter" id="twitter"
                                               aria-describedby="twitter" placeholder="twitter">
                                    </div>


                                    <div class="form-group">
                                        <input type="url" class="form-control" name="facebook" id="facebook"
                                               aria-describedby="facebook" placeholder="facebook">
                                    </div>

                                    <div class="form-group">
                                        <input type="url" class="form-control" name="instagram" id="instagram"
                                               aria-describedby="instagram" placeholder="instagram">
                                    </div>

                                    <div class="form-group">
                                        <input type="url" class="form-control" name="linkedin" id="linkedin"
                                               aria-describedby="linkedin" placeholder="linkedin">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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


<!-- ajouter partenaire-->
<div class="modal fade" id="module_partenaire" tabindex="-1" role="application" aria-labelledby="module_partenaire"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Partenaires</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportPartenaire2" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_Partenaire" role="form"
                                      action="controllers/traitement.php?partenaire=partenaire" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" id="name"
                                               aria-describedby="name" placeholder="Nom du partenaire*" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="logo_partenaire">Logo du partenaire *</label>
                                        <input type="file" class="form-control" name="logo_partenaire" id="logo_partenaire"
                                               aria-describedby="logo_partenaire" required >
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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


<!-- ajouter vie associative-->
<div class="modal fade" id="vie_ass" tabindex="-1" role="application" aria-labelledby="vie_ass"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vie Associative</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportVA" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_via_ass" role="form"
                                      action="controllers/traitement.php?vie_ass=vie_ass" method="post">
                                    <input type="hidden" name="header_id" value="<?= isset($_ENV['header_id'])? $_ENV['header_id'] : '1' ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="lbl" id="lbl"
                                               aria-describedby="lbl" placeholder="Libelle*">
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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

<!-- ajouter images vie associative-->
<div class="modal fade" id="img_vie_ass" tabindex="-1" role="application" aria-labelledby="img_vie_ass"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Image Association</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportIMG_ASS" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_img_va" role="form"
                                      action="controllers/traitement.php?img_vie_ass=img_vie_ass" method="post">
                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="img_url">Inserer une Image</label>
                                        <input type="file" name="img_url" id="img_url" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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


<!-- ajouter cours de langue-->
<div class="modal fade" id="module_langue" tabindex="-1" role="application" aria-labelledby="module_langue"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cours de langues</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportLangue2" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_langue" role="form"
                                      action="controllers/traitement.php?langue=langue" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" id="name"
                                               aria-describedby="name" placeholder="Nom du cours*" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description">
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="img_url">Image descriptive *</label>
                                        <input type="file" class="form-control" name="img_url" id="img_url"
                                               aria-describedby="img_url" required >
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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


<!-- ajouter Valorisation des acquis de l'expérience-->
<div class="modal fade" id="vae" tabindex="-1" role="application" aria-labelledby="vae"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Valorisation des acquis de l'expérience</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportVAE2" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_vae" role="form"
                                      action="controllers/traitement.php?vae=vae" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" id="name"
                                               aria-describedby="name" placeholder="Libelle*" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description">
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="img_url">Image descriptive *</label>
                                        <input type="file" class="form-control" name="img_url" id="img_url"
                                               aria-describedby="img_url" required >
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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


<!-- ajouter les elements à fournir au VAE-->
<div class="modal fade" id="vae_item" tabindex="-1" role="application" aria-labelledby="vae_item"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eléments à fournir</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportVAE3" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_vae" role="form"
                                      action="controllers/traitement.php?vaeitem=vae" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" id="name"
                                               aria-describedby="name" placeholder="Libelle*" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description">
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="img_url">Image descriptive </label>
                                        <input type="file" class="form-control" name="img_url" id="img_url"
                                               aria-describedby="img_url">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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


<!-- ajouter un programme d'assistance jeunes-->
<div class="modal fade" id="paj" tabindex="-1" role="application" aria-labelledby="paj"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Programme d'assistance jeunes</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportPAJ2" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_paj" role="form"
                                      action="controllers/traitement.php?paj=paj" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" id="name"
                                               aria-describedby="name" placeholder="Libelle*" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description">
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="img_url">Image descriptive </label>
                                        <input type="file" class="form-control" name="img_url" id="img_url"
                                               aria-describedby="img_url">
                                    </div>

                                    <div class="form-group">
                                        <label for="fichier">Fiche d'adhesion </label>
                                        <input type="file" class="form-control" name="fichier" id="fichier"
                                               aria-describedby="fichier" >
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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



<!-- ajouter des programmes associatifs-->
<div class="modal fade" id="vie_ass2" tabindex="-1" role="application" aria-labelledby="vie_ass2"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vie Associative</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportVA2" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_via_ass2" role="form"
                                      action="controllers/traitement.php?vie_ass=vie_ass" method="post">
                                    <input type="hidden" name="header_id" value="<?= isset($_ENV['header_id'])? $_ENV['header_id'] : '6' ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="lbl" id="lbl"
                                               aria-describedby="lbl" placeholder="Libelle*">
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" aria-describedby="desc"
                                                  name="desc" id="desc" cols="10" rows="3"
                                                  placeholder="Description"></textarea>
                                    </div>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Importer Image</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="img_url" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Facultatif</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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




<!-- ajouter apropos-->
<div class="modal fade" id="apropos" tabindex="-1" role="application" aria-labelledby="apropos"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apropos</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportA2" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_A" role="form"
                                      action="controllers/traitement.php?apropos=apropos" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="libelle" id="libelle"
                                               aria-describedby="libelle" placeholder="Libelle*" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description"></label>
                                        <textarea name="description" class="form-control" id="description" aria-describedby="description" cols="30" rows="5" placeholder="Description Apropos*"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="avatar">Image descriptive</label>
                                        <input type="file" class="form-control" name="avatar" id="avatar"
                                               aria-describedby="avatar" placeholder="avatar*">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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


<!-- ajouter PAJ-->
<div class="modal fade" id="paj" tabindex="-1" role="application" aria-labelledby="paj"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apropos</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->

                            <div class="p-5">
                                <div id="rapportA2" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_A" role="form"
                                      action="controllers/traitement.php?apropos=apropos" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="libelle" id="libelle"
                                               aria-describedby="libelle" placeholder="Libelle*" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description"></label>
                                        <textarea name="description" class="form-control" id="description" aria-describedby="description" cols="30" rows="5" placeholder="Description Apropos*"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="avatar">Image descriptive</label>
                                        <input type="file" class="form-control" name="avatar" id="avatar"
                                               aria-describedby="avatar" placeholder="avatar*">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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



<!-- Register-->
<div class="modal fade" id="register" tabindex="-1" role="application" aria-labelledby="register"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Souscrire</h5>
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
                                    <div id="statut" class="alert alert-info"> Veuillez remplir tous les champs</div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Créer un compte</h1>
                                    </div>
                                    <form class="user" id="singUp" method="post" onsubmit="return false;">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="nomSingUp" class="form-control form-control-user" id="nomSingUp" placeholder="Nom">
                                                <em><small id="output_nomSingUp"></small></em>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="prenomSingUp" class="form-control form-control-user" id="prenomSingUp" placeholder="Prenom">
                                                <em><small id="output_prenomSingUp"></small></em>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="profession" class="form-control form-control-user" id="profession" placeholder="Profession">
                                            <em><small id="output_profession"></small></em>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="emailSingUp" class="form-control form-control-user" id="emailSingUp" placeholder="Adresse Email">
                                            <em><small id="output_emailSingUp"></small></em>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" name="passwordSingUp" class="form-control form-control-user" id="passwordSingUp" placeholder="Mot de passe">
                                                <em><small id="output_passwordSingUp"></small></em>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="passwordConfirmSingUp" class="form-control form-control-user" id="passwordConfirmSingUp" placeholder="Mot de passe de Confirmation">
                                                <em><small id="output_passwordConfirmSingUp"></small></em>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button id="enreg" class="btn btn-primary btn-user btn-block" type="submit" style="background: #8A2BE2">Envoyer</button>
                                            <center><img id="load_data_SingUp" src="img/loader.gif" class="loader" style="display:none;"></center>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#" data-toggle="modal" data-target="#forgot-password">Mot de passe oublié?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="#" data-toggle="modal" data-target="#register">Avez-vous déjà un compte? Connectez-vous!</a>
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


<!-- Message d'accueil-->
<div class="modal fade" id="msg" tabindex="-1" role="dialog" aria-labelledby="msg" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message d'accueil</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="rapportMsg" class="alert alert-danger"
                                             style="display:none;"></div>
                                        <form id="id_msg" class="user" role="form"
                                              action="controllers/traitement.php?msg=id_msg" method="post">

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="titre_msg"
                                                       id="titre_msg" aria-describedby="titre_msg" maxlength="15"
                                                       placeholder="Titre">
                                            </div>

                                            <div class="form-group">
                                                <textarea class="form-control" name="message1" id="message" cols="30" rows="10"
                                                          placeholder="Message" required></textarea>
                                            </div>

                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Publier"/>
                                                <center><img src="img/loader.gif" class="uploads" style="display:none;"></center>
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
</div>

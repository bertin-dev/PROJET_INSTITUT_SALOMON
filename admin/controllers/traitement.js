


/*COMPTEUR DE VISITEUR*/
$(function(){
    function getonline(){
        $('#users').load('user_online.php', function() {

        });
    }
    setInterval(getonline, 3000);

});

const success_msg = " ajouté avec succès.";
const identite = "Identité du site";
const menu = "Menu";
const footer = "Footer";
const slide = "Slide";
const categorie = "Categorie";
const delete_msg = " Supprimé avec succès.";
const tag = "Tag";
const update_msg = " Modifié avec succès."
const article = " Article"
const result_article = "Veuillez inserer un titre à votre article"
const success_msg_article = " publié avec succès.";

/* ==========================================================================
GESTION DE L AJOUT DU LOGO, TITRE, ICÖNE
========================================================================== */
$(function() {
    $('#idSiteWeb').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.siteWebUploads').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#idSiteWebRapport');
                if(data === 'success'){
                    $('.siteWebUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Publier');
                    cat.html(identite + ' ' + success_msg).show();
                    setTimeout(function () {
                        cat.html(identite + ' ' + success_msg).slideDown().hide();
                        $('body').load('home.php', function() {
                        });
                    }, 5000);

                } else if(data === 'success-update'){
                    $('.siteWebUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Publier');
                    cat.html('l\'identité du site a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html(identite + ' ' + success_msg).slideDown().hide();
                        $('body').load('home.php', function() {
                        });
                    }, 5000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.siteWebUploads').hide();
                    $('.currentSend').attr('value', 'Publier');
                }
            }

        });
    });
});
/* ==========================================================================
GESTION DU MENU
========================================================================== */
$(function() {
    $('#form_menu').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#menuRapport');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Publier');
                    cat.html(menu + ' ' + success_msg).show();
                    setTimeout(function () {
                        cat.html(menu +' ' + success_msg).slideDown().hide();
                        $('body').load('home.php', function() {
                        });
                    }, 5000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Publier');
                    cat.html('l\'identité du site a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('l\'identité du site a été modifié avec succès').slideDown().hide();
                        $('body').load('home.php', function() {
                        });
                    }, 5000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Publier');
                }
            }

        });
    });
});

/* ==========================================================================
GESTION DU SOUS MENU
========================================================================== */
$(function() {
    $('#form_submenu').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#submenuRapport');
                var result = $('#tel');
                var description_sous_menu = $('#localisation');
                var result_submenu1 = $('#result_submenu1');
                var result_submenu2 = $('#result_submenu2');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Publier');
                    cat.html(footer + ' ' + success_msg).show();


                    if(result.hasClass('is-invalid')){
                        result.removeClass('is-invalid');
                        result.addClass('is-valid');
                        $('#valid-feedback').html(data);
                    }

                    setTimeout(function () {
                        cat.html(footer + ' ' + success_msg).slideDown().hide();
                        $('body').load('home.php', function() {
                        });
                    }, 5000);

                } else {

                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    if(result.hasClass('is-valid')){
                        result.removeClass('is-valid');
                        result.addClass('is-invalid');
                    } else{
                        result.addClass('is-invalid');
                    }

                    if(description_sous_menu.hasClass('is-valid')){
                        description_sous_menu.removeClass('is-valid');
                        description_sous_menu.addClass('is-invalid');
                    } else{
                        description_sous_menu.addClass('is-invalid');
                    }

                    result_submenu1.removeClass('valid-feedback');
                    result_submenu1.addClass('invalid-feedback');
                    result_submenu1.html(data).show();

                    result_submenu2.removeClass('valid-feedback');
                    result_submenu2.addClass('invalid-feedback');
                    result_submenu2.html(data).show();

                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Publier');
                }
            }

        });
    });
});


/* ==========================================================================
GESTION DU SLIDE
========================================================================== */
$(function() {
    $('#form_slide').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#slideRapport');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Publier');
                    cat.html(slide + ' ' + success_msg).show();
                    setTimeout(function () {
                        cat.html(slide +' ' + success_msg).slideDown().hide();
                        $('body').load('home.php', function() {
                        });
                    }, 5000);

                } else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Publier');
                }
            }

        });
    });
});


/* ==========================================================================
GESTION DES CATEGORIES
========================================================================== */
$(function() {
    $('#form_add_categories').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#categoriesRapport');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Publier');
                    cat.html(categorie + ' ' + success_msg).show();
                    setTimeout(function () {
                        cat.html(categorie +' ' + success_msg).slideDown().hide();
                        $('body').load('list_posts.php', function() {
                        });
                    }, 5000);

                } else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Publier');
                }
            }

        });
    });
});

/* ==========================================================================
UPDATE CATEGORIES
========================================================================== */
$(function() {
    $('#form_update_categories').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('.rapport');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Modifier');
                    cat.html(categorie + ' ' + update_msg).show();
                    setTimeout(function () {
                        cat.html(categorie +' ' + update_msg).slideDown().hide();
                        $('body').load('list_posts.php', function() {
                        });
                    }, 5000);

                } else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Modifer');
                }
            }

        });
    });
});


/* ==========================================================================
ADD TAGS
========================================================================== */
$(function() {
    $('#form_add_tag').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('.rapport');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html(tag + ' ' + success_msg).show();
                    setTimeout(function () {
                        cat.html(tag +' ' + success_msg).slideDown().hide();
                        $('body').load('list_posts.php', function() {
                        });
                    }, 25000);

                } else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});

/* ==========================================================================
UPDATE TAGS
========================================================================== */
$(function() {
    $('#form_update_tag').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('.rapport');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html(tag + ' ' + update_msg).show();
                    setTimeout(function () {
                        cat.html(tag +' ' + update_msg).slideDown().hide();
                        $('body').load('list_posts.php', function() {
                        });
                    }, 5000);

                } else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});























































/* ==========================================================================
BLOC SERVICES
========================================================================== */

/* ==========================================================================
GESTION DE L AJOUT DES SERVICES DANS LA ZONE SERVICES
========================================================================== */
$(function() {

    $('#servicesDispo').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.servicesDispoUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#servicesDispoRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.servicesDispoUploads').hide();
                }
                else
                {
                    $('.servicesDispoUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté un Service').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté un Service').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L AJOUT DES CATEGORIES SERVICES DANS LA ZONE SERVICES
========================================================================== */
$(function() {

    $('#cat_outils_Tech').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.cat_outils_TechUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#cat_outils_TechRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.cat_outils_TechUploads').hide();
                }
                else
                {
                    $('.cat_outils_TechUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez AJouté une Catégorie d\'outils Techniques').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Catégorie d\'outils Techniques').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L'AJOUT DES OUTILS TECHNIQUES DANS LA ZONE SERVICES
========================================================================== */
$(function() {

    $('#outils_Technique').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.outils_TechUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#outils_TechRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.outils_TechUploads').hide();
                }
                else
                {
                    $('.outils_TechUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté un Outils Technique').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté un Outils Technique').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});

/* ==========================================================================
GESTION DE L AJOUT DES MODULES-OUTILS COMMUN DANS LA ZONE SERVICES
========================================================================== */
$(function() {
    $('#moduleTechCommun').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.moduleTechCommunUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#moduleTechCommunRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.moduleTechCommunUploads').hide();
                }
                else
                {
                    $('.moduleTechCommunUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté un Module').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté un Module').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});



/* ==========================================================================
GESTION DE L AJOUT DES MODULES ADMIN DANS LA ZONE SERVICES
========================================================================== */
$(function() {
    $('#moduleAdmin').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.moduleAdminUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#moduleAdminRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.moduleAdminUploads').hide();
                }
                else
                {
                    $('.moduleAdminUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté un Module').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté un Module').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L AJOUT DES CATEGORIES MODULE CLIENT DANS LA ZONE SERVICES
========================================================================== */
$(function() {
    $('#catModuleClient').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.catModuleClientUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#catModuleClientRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.catModuleClientUploads').hide();
                }
                else
                {
                    $('.catModuleClientUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Categorie Module Client').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté une Categorie Module Client').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});

/* ==========================================================================
GESTION DE L'AJOUT DE L'AGENDA DANS LA ZONE CONFIG PAGE
========================================================================== */
$(function() {

    $('#program_annuel').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.agendaUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#agendaRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.agendaUploads').hide();
                }
                else
                {
                    $('.agendaUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté un Nouveau Programme').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté un Nouveau Programme').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});



/* ==========================================================================
GESTION DE L'AJOUT DE L'IMAGE DANS LA ZONE CONFIG PAGE
========================================================================== */
$(function() {

    $('#img').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.imgUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#imgRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.imgUploads').hide();
                }
                else
                {
                    $('.imgUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Nouvelle Image').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Nouvelle Image').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L'AJOUT DE L'IMAGE DANS LA ZONE CONFIG PAGE
========================================================================== */
/*$(function() {

    $('#specialite').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        $('.specialiteUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'html', // selon le retour attendu
            data:data,
            success:function(data){
                var cat = $('#specialiteRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.imgUploads').hide();
                }
                else
                {
                    $('.specialiteUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Nouvelle Spécialité').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Nouvelle Spécialité').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});*/




/* ==========================================================================
GESTION DE L'AJOUT DE L'ACTIVITE ENCOURS
========================================================================== */
$(function() {

    $('#activite').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.activiteUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#activiteRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.activiteUploads').hide();
                }
                else
                {
                    $('.activiteUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Nouvelle Activité').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Nouvelle Activité').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});



/* ==========================================================================
GESTION DE L'AJOUT DE LA CATEGORIE DE SOLUTIONS
========================================================================== */
$(function() {

    $('#cat_solution').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.cat_solutionUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#cat_solutionRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.cat_solutionUploads').hide();
                }
                else
                {
                    $('.cat_solutionUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Nouvelle Categorie').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Nouvelle Categorie').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L'AJOUT DE LA SOLUTION
========================================================================== */
$(function() {

    $('#solution').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.solutionUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#solutionRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.solutionUploads').hide();
                }
                else
                {
                    $('.solutionUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Nouvelle Solution').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Nouvelle Solution').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});





/* ==========================================================================
GESTION DES MODULES
========================================================================== */
$(function() {
    $('.form_module').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportM, #rapportMod');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Le module a été ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('Le module a été ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"module.php?name=formation");
                    }, 5000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Le module a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('Le module a été Modifié avec succès').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"module.php?name=formation");
                    }, 5000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});


/* ==========================================================================
GESTION DES FORMATIONS
========================================================================== */
$(function() {
    $('.form_formation').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportF, #rapportModif');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('une formation a été ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('Le module a été ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"module.php?name=formation");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Une formation a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('Une formation a été Modifié avec succès').slideDown().hide();
                        $('body').load('module.php?name=formation', function() {
                        });
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});


/* ==========================================================================
GESTION DES EQUIPES PEDAGOGIQUES
========================================================================== */
$(function() {
    $('.form_EquipP').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportEquipP, #rapportEquipP2');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('un utilisateur a été ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('un utilisateur a été ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"module.php?name=equipe_ped");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Un utilisateur a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('Un utilisateur a été Modifié avec succès').slideDown().hide();
                        $('body').load('module.php?name=equipe_ped', function() {
                        });
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});


/* ==========================================================================
GESTION DES PARTENAIRES
========================================================================== */
$(function() {
    $('.form_Partenaire').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportPartenaire, #rapportPartenaire2');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('un partenaire a été ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('un partenaire a été ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"module.php?name=partenaire");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Un partenaire a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('Un partenaire a été Modifié avec succès').slideDown().hide();
                        $('body').load('module.php?name=partenaire', function() {
                        });
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});



/* ==========================================================================
GESTION DE LA VIE ASSOCIATIVE
========================================================================== */
$(function() {
    $('.form_via_ass').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportModiVA, #rapportVA');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('un element a été ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('un élement a été ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"module.php?name=vie_ass&id=1");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Le module a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('un élement a été Modifié avec succès').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"module.php?name=vie_ass&id=1");
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});

/* ==========================================================================
GESTION DES IMAGES DE L'ASSOCIATION
========================================================================== */
$(function() {
    $('.form_img_va').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportIMG_ASS, #rapportVAModif');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('une image a été ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('une image a été ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"module.php?name=vie_ass");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Une image a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('Une image a été Modifié avec succès').slideDown().hide();
                        $('body').load('module.php?name=vie_ass', function() {
                        });
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});


/* ==========================================================================
GESTION DES COURS DE LANGUES
========================================================================== */
$(function() {
    $('.form_langue').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportLangue, #rapportLangue2');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('un cours a été ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('un cours a été ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"module.php?name=langue");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Un cours a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('Un cours a été Modifié avec succès').slideDown().hide();
                        $('body').load('module.php?name=langue', function() {
                        });
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});




/* ==========================================================================
GESTION DE LA VALORISATION DES ACQUIS DE L'EXPERIENCE
========================================================================== */
$(function() {
    $('.form_vae').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportVAE, #rapportVAE2, #rapportVAE3, #rapportVAE4');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Information sur la VAE ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('information sur la VAE ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"module.php?name=vae");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('information sur la VAE Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('information sur la VAE Modifié avec succès').slideDown().hide();
                        $('body').load('module.php?name=vae', function() {
                        });
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});



/* ==========================================================================
GESTION DU PROGRAMME D'ASSISTANCE JEUNES
========================================================================== */
$(function() {
    $('.form_paj').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportPAJ, #rapportPAJ2');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Information sur le PAJ ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('information sur le PAJ ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"module.php?name=paj");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('information sur le PAJ Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('information sur la VAE Modifié avec succès').slideDown().hide();
                        $('body').load('module.php?name=paj', function() {
                        });
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});



/* ==========================================================================
GESTION DU PROGRAMME ASSOCIATIF
========================================================================== */
$(function() {
    $('.form_via_ass2').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportModiVA2, #rapportVA2');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('un element a été ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('un élement a été ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"body.php?id=6");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Le programme a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('le programme a été Modifié avec succès').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"body.php?id=6");
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});



/* ==========================================================================
GESTION DU BB CODE DE L'AJOUT DES ARTICLES
========================================================================== */
$(document).ready(function () {
    $('#desc_article1').wysiwyg({

    });
});


/* ==========================================================================
MODIFIER ARTICLE
========================================================================== */

$(function() {

    $('#form_article1 input').focus(function () {
        $('.rapport1').fadeOut(800);
    });
    $('#form_article1').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        //alert($('#editor').val());
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: 'controllers/traitement.php?update_article=article',
            type: 'post',
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data: data,
            success:function(data){
                var cat = $('.rapport1');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Publier');
                    cat.html(article + ' ' + success_msg_article).show();
                    setTimeout(function () {
                        cat.html(article +' ' + success_msg_article).slideDown().hide();
                        $('body').load('body.php?id=8', function() {
                        });
                    }, 3000);

                } else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Publier');
                }
            }

        });
    });
});

/* ==========================================================================
UPLOAD IMAGE ARTICLE
========================================================================== */
$(document).ready( function() {
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-upload1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp1").change(function(){
        readURL(this);
    });
});





/* ==========================================================================
MODIFIER NEWSLETTER ET CONTACT
========================================================================== */
$(function() {
    $('.form_new').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportN');
                 if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('cet élément a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('cet élément a été Modifié avec succès').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"body.php?id=10");
                    }, 2000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});



/* ==========================================================================
GESTION APROPOS
========================================================================== */
$(function() {
    $('.form_A').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportA, #rapportA2');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Apropos ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('Apropos ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"body.php?id=2");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Apropos Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('Apropos Modifié avec succès').slideDown().hide();
                        $('body').load('body.php?id=2', function() {
                        });
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});


$(function () {
   $('#allnotifs').on('click', function (e) {
       e.preventDefault();
       $.ajax({
           url: 'controllers/traitement.php',
           method: 'POST',
           data: {
               notifs: 1,
           },
           dataType: 'text',
           beforeSend: function () {
               console.log('before send');
           },
           success:function (data) {
               $('#notif').html(data);
           },
           error: function(data){
               console.log('Erreur de Chargement des notifications');
           },
           complete: function (data) {
              console.log('chargement terminé')
           }
       });
   });
});



$(function () {
    /* ==========================================================================
  GESTION DU SYSTEME D'INSCRIPTION
  ========================================================================== */

    $('#singUp input').focus(function () {
        $('#statut').fadeOut(800);
    });

    //verification si le Nom est ok ou a déjà été utilisé
    $('#nomSingUp').keyup(function () {
        nomSingUp();
    });

    $('#prenomSingUp').keyup(function () {
        prenomSingUp();
    });

    $('#emailSingUp').keyup(function () {
        emailSingUp();
    });

    $('#passwordSingUp').keyup(function () {
        passwordSingUp();
    });

    $('#passwordConfirmSingUp').keyup(function () {
        passwordConfirmSingUp();
    });

    //fonction de verification du Nom en ajax
    function nomSingUp() {
        $.ajax({
            type: 'post',
            url: 'controllers/traitement.php?singUp=singUp',
            data: {
                'nomSingUp': $('#nomSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    console.log(data);
                    $('#output_nomSingUp').html("");
                    return true;
                }
                else{
                    $('#output_nomSingUp').css({
                        'color': 'red',
                        'font-weight': 'bold',
                        'margin': 'initial',
                        'padding': 'initial'
                    }).html(data);
                }
            }
        });


    }

    //fonction de verification du Prenom en ajax
    function prenomSingUp() {
        $.ajax({
            type: 'post',
            url: 'controllers/traitement.php?singUp=singUp',
            data: {
                'prenomSingUp': $('#prenomSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_prenomSingUp').html("");
                    console.log(data);
                    return true;
                }
                else{
                    $('#output_prenomSingUp').css('color', 'red').html(data);
                }
            }
        });


    }

    //fonction de verification de l'email en ajax
    function emailSingUp() {
        $.ajax({
            type: 'post',
            url: 'controllers/traitement.php?singUp=singUp',
            data: {
                'emailSingUp': $('#emailSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    console.log(data);
                    $('#output_emailSingUp').html("");
                    return true;
                }
                else{
                    $('#output_emailSingUp').css('color', 'red').html(data);
                }
            }
        });


    }

    //fonction de verification du password en ajax
    function passwordSingUp() {

        if($('#passwordSingUp').val().length < 5){
            $('#output_passwordSingUp').css('color', 'red').html("<br>Trop court (5 caractères minimum.)");
        }else if($('#passwordConfirmSingUp').val()!='' && $('#passwordConfirmSingUp').val()!= $('#passwordSingUp').val()){
            $('#output_passwordSingUp').css('color', 'red').html('<br>Les deux mots de passe sont différents');
            $('#output_passwordConfirmSingUp').css('color', 'red').html('<br>Les deux mots de passe sont différents');
        }else{
            $('#output_passwordSingUp').html("");
            $('#output_passwordConfirmSingUp').html("");
            console.log('vérification validé');
        }
    }



    //fonction de verification du password confirme en ajax
    function passwordConfirmSingUp() {
        $.ajax({
            type: 'post',
            url: 'controllers/traitement.php?singUp=singUp',
            data: {
                'passwordSingUp': $('#passwordSingUp').val(),
                'passwordConfirmSingUp': $('#passwordConfirmSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    console.log('mot de passe et mot de passe de confirmations sont conformes');
                    /*$('#output_passwordSingUp').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    $('#output_passwordConfirmSingUp').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');*/
                    return true;
                }
                else{
                    $('#output_passwordConfirmSingUp').css('color', 'red').html(data);
                }
            }
        });


    }

    $('#singUp').submit(function () {
        var statut1 = $('#statut');
        var nom = $('#nomSingUp').val(), prenom = $('#prenomSingUp').val(), email1 = $('#emailSingUp').val(), password1 = $('#passwordSingUp').val();


        if (nom == '' || prenom == '' || email1 == '' || password1 == '') {
            statut1.html('Veuillez Remplir Tous les Champs').fadeIn(400);
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();

            $.ajax({
                type: 'post',
                url: 'controllers/traitement.php?singUpSubmit=singUp',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                beforeSend: function () {
                    $('#enreg').html('En cours...');
                    $('#load_data_SingUp').show().fadeIn();
                },
                success: function (data) {
                    if(data != 'success'){
                        statut1.html(data).fadeIn(400);
                        $('#enreg').html('Envoyer');
                        $('#load_data_SingUp').show().fadeOut();
                    }
                    else {
                        $('#enreg').html('Envoyer');
                        $('#load_data_SingUp').show().fadeOut();
                        statut1.html("Enregistrement éffectué avec succès");
                        setTimeout(function () {
                            location.href='index.php';
                        }, 3000);

                    }
                }

            });

        }


    });
});



/* ==========================================================================
GESTION DE L AJOUT DU MESSAGE D'ACCUEIL
========================================================================== */
$(function() {
    $('#id_msg').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.siteWebUploads').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportMsg');
                if(data === 'success'){
                    $('.uploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Publier');
                    cat.html('le message a été ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('le message a été ajouté avec succès.').slideDown().hide();
                        $('body').load('index.php', function() {
                        });
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.uploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Publier');
                    cat.html('le message a été Modifié avec succès.').show();
                    setTimeout(function () {
                        cat.html('le message a été Modifié avec succès.').slideDown().hide();
                        $('body').load('index.php', function() {
                        });
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.uploads').hide();
                    $('.currentSend').attr('value', 'Publier');
                }
            }

        });
    });
});



/* ==========================================================================
GESTION DES MESSAGES
========================================================================== */
$(function() {
    $('.form_msg, .form_TSW, .form_S, .form_Ft').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportMsg, #rapportTSW, #rapportS, #rapportFt');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Un élément a été ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('Un élément a été ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"list.php?id=1");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Un élément a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('Un élément a été Modifié avec succès').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"list.php?id=1");
                    }, 3000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});
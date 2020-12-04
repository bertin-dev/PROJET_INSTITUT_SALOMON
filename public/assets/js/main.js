/**
* Template Name: Flattern - v2.1.0
* Template URL: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
!(function($) {
  "use strict";

  // Preloader
  $(window).on('load', function() {
    if ($('#preloader').length) {
      $('#preloader').delay(100).fadeOut('slow', function() {
        $(this).remove();
      });
    }
  });

  // Smooth scroll for the navigation menu and links with .scrollto classes
  var scrolltoOffset = $('#header').outerHeight() - 1;
  $(document).on('click', '.nav-menu a, .mobile-nav a, .scrollto', function(e) {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        e.preventDefault();

        var scrollto = target.offset().top - scrolltoOffset;

        if ($(this).attr("href") == '#header') {
          scrollto = 0;
        }

        $('html, body').animate({
          scrollTop: scrollto
        }, 1500, 'easeInOutExpo');

        if ($(this).parents('.nav-menu, .mobile-nav').length) {
          $('.nav-menu .active, .mobile-nav .active').removeClass('active');
          $(this).closest('li').addClass('active');
        }

        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
          $('.mobile-nav-overly').fadeOut();
        }
        return false;
      }
    }
  });

  // Activate smooth scroll on page load with hash links in the url
  $(document).ready(function() {
    if (window.location.hash) {
      var initial_nav = window.location.hash;
      if ($(initial_nav).length) {
        var scrollto = $(initial_nav).offset().top - scrolltoOffset;
        $('html, body').animate({
          scrollTop: scrollto
        }, 1500, 'easeInOutExpo');
      }
    }
  });

  // Mobile Navigation
  if ($('.nav-menu').length) {
    var $mobile_nav = $('.nav-menu').clone().prop({
      class: 'mobile-nav d-lg-none'
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" class="mobile-nav-toggle d-lg-none"><i class="icofont-navigation-menu"></i></button>');
    $('body').append('<div class="mobile-nav-overly"></div>');

    $(document).on('click', '.mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
      $('.mobile-nav-overly').toggle();
    });

    $(document).on('click', '.mobile-nav .drop-down > a', function(e) {
      e.preventDefault();
      $(this).next().slideToggle(300);
      $(this).parent().toggleClass('active');
    });

    $(document).click(function(e) {
      var container = $(".mobile-nav, .mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
          $('.mobile-nav-overly').fadeOut();
        }
      }
    });
  } else if ($(".mobile-nav, .mobile-nav-toggle").length) {
    $(".mobile-nav, .mobile-nav-toggle").hide();
  }
  // Toggle .header-scrolled class to #header when page is scrolled
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('#header').addClass('header-scrolled');
    } else {
      $('#header').removeClass('header-scrolled');
    }
  });

  if ($(window).scrollTop() > 100) {
    $('#header').addClass('header-scrolled');
  }

  // Stick the header at top on scroll
  $("#header").sticky({
    topSpacing: 0,
    zIndex: '50'
  });

  // Intro carousel
  var heroCarousel = $("#heroCarousel");
  var heroCarouselIndicators = $("#hero-carousel-indicators");
  heroCarousel.find(".carousel-inner").children(".carousel-item").each(function(index) {
    (index === 0) ?
    heroCarouselIndicators.append("<li data-target='#heroCarousel' data-slide-to='" + index + "' class='active'></li>"):
      heroCarouselIndicators.append("<li data-target='#heroCarousel' data-slide-to='" + index + "'></li>");
  });

  heroCarousel.on('slid.bs.carousel', function(e) {
    $(this).find('.carousel-content ').addClass('animate__animated animate__fadeInDown');
  });

  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
    }
  });

  $('.back-to-top').click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 1500, 'easeInOutExpo');
    return false;
  });

  // Porfolio isotope and filter
  $(window).on('load', function() {
    var portfolioIsotope = $('.portfolio-container').isotope({
      itemSelector: '.portfolio-item',
      layoutMode: 'fitRows'
    });

    $('#portfolio-flters li').on('click', function() {
      $("#portfolio-flters li").removeClass('filter-active');
      $(this).addClass('filter-active');

      portfolioIsotope.isotope({
        filter: $(this).data('filter')
      });
      aos_init();
    });

    // Initiate venobox (lightbox feature used in portofilo)
    $(document).ready(function() {
      $('.venobox').venobox();
    });
  });

  // Skills section
  $('.skills-content').waypoint(function() {
    $('.progress .progress-bar').each(function() {
      $(this).css("width", $(this).attr("aria-valuenow") + '%');
    });
  }, {
    offset: '80%'
  });

  // Portfolio details carousel
  $(".portfolio-details-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    items: 1
  });

  // Init AOS
  function aos_init() {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true
    });
  }
  $(window).on('load', function() {
    aos_init();
  });

})(jQuery);



//Traitement de la partie dynamique (BLOG)
$(function () {

  var PostId = '';

  //chargement dynamique des Articles
  var myArticles =  $('#articles');
  myArticles.on('click', '.link_articles', function (e) {
    e.preventDefault();
    var content = $(this).attr('data');
    var tab = content.split('&');
    eval(tab[0]);
    if(articles==='')
      return;
    $.ajax({
      url: '../core/controller/verification.php',
      method: 'POST',
      data: {
        articles_click: articles
      },
      dataType: 'json',
      beforeSend: function () {
        $('.loader_blog').show();
      },
      success:function (data) {
        myArticles.html(data.article_response);
        $('.loader_blog').hide();
        PostId = data.postID;
      },
      error: function(data){
        console.log("Erreur de chargement des articles");
      },
      complete: function (data) {
        $('.loader_blog').hide();
      }
    });

  });

  //Commentaires

  var myArticles =  $('#articles');
  var cat = $('#rapport_comment');

  $('#form_comment input, #form_comment textarea').focus(function () {
    cat.fadeOut(800);
  });

  myArticles.on('keyup', '#name', function () {
    name();
  });

  myArticles.on('keyup', '#email', function () {
    email();
  });

  myArticles.on('keyup', '#comment', function () {
    comment();
  });

  //fonction de verification du Nom en ajax
  function name() {
    var nom = $('#name');
    var validate = $('#validate_name');
    $.ajax({
      type: 'post',
      url: '../core/controller/verification.php?comment=comment',
      data: {
        'name': nom.val()
      },
      success: function (data) {

        if(data=='success'){

          if(nom.hasClass('is-invalid')){
            nom.removeClass('is-invalid');
            nom.addClass('is-valid');
            //$('#valid-feedback').html(data);
          }
          return true;
        }
        else{

          if(nom.hasClass('is-valid')){
            nom.removeClass('is-valid');
            nom.addClass('is-invalid');
          } else{
            nom.addClass('is-invalid');
          }

          validate.removeClass('valid-feedback');
          validate.addClass('invalid-feedback');
          validate.html(data).show();

          validate.css({
            'color': 'red',
            'font-weight': 'bold',
            'margin': 'initial',
            'padding': 'initial',
            'font-size': '65%'
          }).html(data);

          /* setTimeout(function () {
               $('#output_visitor').hide();

           }, 7000);*/
        }
      }
    });


  }


  //fonction de verification du Nom en ajax
  function email() {
    var email = $('#email');
    var validate = $('#validate_email');
    $.ajax({
      type: 'post',
      url: '../core/controller/verification.php?comment=comment',
      data: {
        'email': email.val()
      },
      success: function (data) {
        if(data=='success'){

          if(email.hasClass('is-invalid')){
            email.removeClass('is-invalid');
            email.addClass('is-valid');
            //$('#valid-feedback').html(data);
          }
          return true;
        }
        else{

          if(email.hasClass('is-valid')){
            email.removeClass('is-valid');
            email.addClass('is-invalid');
          } else{
            email.addClass('is-invalid');
          }

          validate.removeClass('valid-feedback');
          validate.addClass('invalid-feedback');
          validate.html(data).show();

          validate.css({
            'color': 'red',
            'font-weight': 'bold',
            'margin': 'initial',
            'padding': 'initial',
            'font-size': '65%'
          }).html(data);

          /* setTimeout(function () {
               $('#output_email_visitor').hide();

           }, 7000);*/
        }
      }
    });


  }

  //fonction de verification du MESSAGE en ajax
  function comment() {
    var comment = $('#comment');
    var validate = $('#validate_comment');
    $.ajax({
      type: 'post',
      url: '../core/controller/verification.php?comment=comment',
      data: {
        'comment': comment.val()
      },
      success: function (data) {
        if(data=='success'){

          if(comment.hasClass('is-invalid')){
            comment.removeClass('is-invalid');
            comment.addClass('is-valid');
          }
          return true;
        }
        else{

          if(comment.hasClass('is-valid')){
            comment.removeClass('is-valid');
            comment.addClass('is-invalid');
          } else{
            comment.addClass('is-invalid');
          }

          validate.removeClass('valid-feedback');
          validate.addClass('invalid-feedback');
          validate.html(data).show();

          validate.css({
            'color': 'red',
            'font-weight': 'bold',
            'margin': 'initial',
            'padding': 'initial',
            'font-size': '65%'
          }).html(data);

          /* setTimeout(function () {
               $('#output_message_visitor').hide();

           }, 7000);*/
        }
      }
    });


  }

  //fonction de soumission du formulaire
  myArticles.on('submit', '#form_comment', function () {

    var name = $('#name').val(), email = $('#email').val(), comment = $('#comment').val();

    if (name == '' || email == '' || comment == '') {
      //alert("Veuillez remplir tous les champs");
      cat.html("Veuillez remplir tous les champs").show();
    }
    else {
      var $form = $(this);
      var formdata = (window.FormData) ? new FormData($form[0]) : null;
      var donnee = (formdata !== null) ? formdata : $form.serialize();

      $.ajax({
        type: 'post',
        url: '../core/controller/submit.php?comment=comment',
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload
        data: donnee,
        beforeSend: function () {
          $('.loader').show();
          $('.currentSend').html('Encours...');
        },
        success: function (data) {
          if(data != 'success'){

            cat.html(data).show();
            $('.loader').hide();
            $('.currentSend').html('Commenter');

          }
          else {

            $('.loader').hide();
            cat.removeClass('alert-danger');
            cat.addClass('alert-success');
            $('.currentSend').html('Commenter');
            cat.html('Commentaire ajouté avec succès.').show();

            /* setTimeout(function () {
                 $('#output_visitor').fadeOut().hide();

             }, 7000);*/
          }
        },
        error: function(){
          console.log('Erreur de Chargement des commentaires');
        },
        complete: function () {
          load_comments(PostId);
        }

      });

    }
  });

  //chargement dynamique de la Pagination
  $('.pagination_link').on('click', function (e) {
    e.preventDefault();
    var content = $(this).attr('data');
    var tab = content.split('&');
    eval(tab[0]);
    eval(tab[1]);

    if(pages==='' || MessagesParPage==='')
      return;
    $.ajax({
      url: '../core/controller/verification.php',
      method: 'POST',
      data: {
        pagination: pages,
        nbre_Article: MessagesParPage
      },
      dataType: 'text',
      beforeSend: function () {
        $('.loader_blog').show();
      },
      success:function (data) {
        myArticles.html(data);
      },
      error: function(data){
        console.log('Erreur de Chargement des Paginations');
      },
      complete: function (data) {
        $('.loader_blog').hide();
      }
    });

  });


  //SYSTEME D AFFICHAGE DES MESSAGES INSTANTANEES
  function load_comments(postID = ''){
    $.ajax({
      url: '../core/controller/verification.php',
      method: 'post',
      data: {postID: postID},
      dataType: 'json',
      success: function (data) {
        $('.blog-comments').html(data.commentaires).delay(1000).fadeIn();
      },
      error: function(data){
        console.log("Erreur de chargement des commentaires");
      }
    });
  }


  /*myArticles.on('click', 'h5 a', function (e) {
    e.preventDefault();

    var I = $(this).attr('data');
    var response = $('#commentaire-reponses' + I);

    if(response.hasClass('collapse')){
      //alert("1");
      response.removeClass('collapse').delay(500).fadeIn();
    } else{
      //alert("2");
      response.addClass('collapse').delay(500).fadeOut();
    }

  });*/

  //REPONSES DES COMMENTAIRES UTILISATEURS

  var item_name = '';
  var id_reply = '';
  myArticles.on('keyup', 'form input:text', function () {
    var I = $(this).attr('data');
    id_reply = I;
     item_name = $('#name' + I);
    name1(item_name, I);
  });

  //fonction de verification du Nom en ajax
  function name1(myName, id) {

    var validate = $('#validate_name' + id);
    $.ajax({
      type: 'post',
      url: '../core/controller/verification.php?comment=comment',
      data: {
        'name': myName.val()
      },
      success: function (data) {

        if(data=='success'){

          if(myName.hasClass('is-invalid')){
            myName.removeClass('is-invalid');
            myName.addClass('is-valid');
            //$('#valid-feedback').html(data);
          }
          return true;
        }
        else{

          if(myName.hasClass('is-valid')){
            myName.removeClass('is-valid');
            myName.addClass('is-invalid');
          } else{
            myName.addClass('is-invalid');
          }

          validate.removeClass('valid-feedback');
          validate.addClass('invalid-feedback');
          validate.html(data).show();

          validate.css({
            'color': 'red',
            'font-weight': 'bold',
            'margin': 'initial',
            'padding': 'initial',
            'font-size': '65%'
          }).html(data);

          /* setTimeout(function () {
               $('#output_visitor').hide();

           }, 7000);*/
        }
      }
    });


  }


  var item_email = '';
  myArticles.on('keyup', 'form input[type=email]', function () {
    var I = $(this).attr('data');
    id_reply = I;
    item_email = $('#email' + I);
    email1(item_email, I);
  });
  //fonction de verification du Nom en ajax
  function email1(myEmail, id) {
    var validate = $('#validate_email' + id);
    $.ajax({
      type: 'post',
      url: '../core/controller/verification.php?comment=comment',
      data: {
        'email': myEmail.val()
      },
      success: function (data) {
        if(data=='success'){

          if(myEmail.hasClass('is-invalid')){
            myEmail.removeClass('is-invalid');
            myEmail.addClass('is-valid');
            //$('#valid-feedback').html(data);
          }
          return true;
        }
        else{

          if(myEmail.hasClass('is-valid')){
            myEmail.removeClass('is-valid');
            myEmail.addClass('is-invalid');
          } else{
            myEmail.addClass('is-invalid');
          }

          validate.removeClass('valid-feedback');
          validate.addClass('invalid-feedback');
          validate.html(data).show();

          validate.css({
            'color': 'red',
            'font-weight': 'bold',
            'margin': 'initial',
            'padding': 'initial',
            'font-size': '65%'
          }).html(data);

          /* setTimeout(function () {
               $('#output_email_visitor').hide();

           }, 7000);*/
        }
      }
    });


  }


  var item_comment = '';
  myArticles.on('keyup', 'form textarea', function () {
    var I = $(this).attr('data');
    id_reply = I;
    item_comment = $('#comment' + I);
    comment1(item_comment, I);
  });
  //fonction de verification du MESSAGE en ajax
  function comment1(myComment, id) {
    var validate = $('#validate_comment' + id);
    $.ajax({
      type: 'post',
      url: '../core/controller/verification.php?comment=comment',
      data: {
        'comment': myComment.val()
      },
      success: function (data) {
        if(data=='success'){

          if(myComment.hasClass('is-invalid')){
            myComment.removeClass('is-invalid');
            myComment.addClass('is-valid');
          }
          return true;
        }
        else{

          if(myComment.hasClass('is-valid')){
            myComment.removeClass('is-valid');
            myComment.addClass('is-invalid');
          } else{
            myComment.addClass('is-invalid');
          }

          validate.removeClass('valid-feedback');
          validate.addClass('invalid-feedback');
          validate.html(data).show();

          validate.css({
            'color': 'red',
            'font-weight': 'bold',
            'margin': 'initial',
            'padding': 'initial',
            'font-size': '65%'
          }).html(data);

          /* setTimeout(function () {
               $('#output_message_visitor').hide();

           }, 7000);*/
        }
      }
    });


  }


  myArticles.on('submit', 'form', function () {

    if(item_name==='' || item_email==='' || item_comment===''){
      alert("Veuillez remplir un ou plusieurs champs.");
    } else {

      var item_name1 = encodeURIComponent(item_name.val());
      var item_email1 = encodeURIComponent(item_email.val());
      var item_comment1 = encodeURIComponent(item_comment.val());


      $.ajax({
        type: 'POST',
        url: '../core/controller/submit.php?reply='+id_reply,
        data: "item_name1="+item_name1 + "&item_email1=" + item_email1 + "&item_comment1=" + item_comment1,
        beforeSend: function () {
          $('.loader').show();
          $('.currentSend').html('Encours...');
        },
        success: function (data) {
          if(data != 'success'){

            alert(data);
            $('.loader').hide();
            $('.currentSend').html('Commenter');
          }
          else {

            $('.loader').hide();

          }
        },
        error: function(){
          console.log('Erreur de Chargement des commentaires');
        },
        complete: function () {
          load_comments(PostId);
        }

      });
    }

  });




  //chargement dynamique des Archives
  $('.archive').click(function (e) {
    e.preventDefault();
    var content = $(this).attr('data');
    var tab = content.split('&');
    eval(tab[0]);
    eval(tab[1]);
    if(mois==='' || annee==='')
      return;
    $.ajax({
      url: '../core/controller/verification.php',
      method: 'POST',
      data: {
        m: mois,
        y: annee
      },
      dataType: 'text',
      beforeSend: function () {
        $('.loader').show();
      },
      success:function (data) {
        myArticles.html(data);
      },
      error: function(data){
        console.log('Erreur de Chargement des Archives');
      },
      complete: function (data) {
        $('.loader').hide();
      }
    });

  });

  //chargement dynamique des Catégories
  $('.categorie').on('click', function (e) {
    e.preventDefault();
    var content = $(this).attr('data');
    //var tab = content.split('&');
    //eval(tab[0]);
    if(content==='')
      return;
    $.ajax({
      url: '../core/controller/verification.php',
      method: 'POST',
      data: {
        categories: content
      },
      dataType: 'text',
      beforeSend: function () {
        $('.loader').show();
      },
      success:function (data) {
        myArticles.html(data);
      },
      error: function(data){
        console.log('Erreur de Chargement des Catégories');
      },
      complete: function (data) {
        $('.loader').hide();
      }
    });

  });


  /* ==========================================================================
GESTION DU SYSTEME DE RECHERCHE INSTANTANE SUR LE BLOG
========================================================================== */
  $('#search_contenu').keyup(function () {
    search();
  });

  //fonction de verification du Nom en ajax
  function search() {
    var contenu =  $('#search_contenu').val();
    var retour = '';
    $.ajax({
      type: 'GET',
      url: '../core/controller/verification.php',
      data: {
        'search_contenu': contenu
      },
      dataType: 'json',
      success: function (data) {
        if(data.resultat=='Aucun'){
          $('#output_search').css({
            'font-weight': 'bold',
            'margin': 'initial',
            'padding': 'initial',
            'font-size': '65%'
          }).html('Aucun résultat trouvé');
          myArticles.empty();
          /*setTimeout(function () {
              $('#output_search').hide();

          }, 7000);*/
        }
        else
        {
          if(data.compteur <= 1)
            retour += data.compteur + ' résultat trouvé';
          else
            retour += data.compteur + ' résultats trouvés';

          myArticles.html(data.resultat);
          $('#output_search').css({
            'font-weight': 'bold',
            'margin': 'initial',
            'padding': 'initial',
            'font-size': '65%'
          }).html(retour);

        }

      }
    });

  }



  /* ==========================================================================
GESTION DU SYSTEME DE NEWSLETTER
========================================================================== */

  $('#newsletter').keyup(function () {
    newsletter();
  });

  //fonction de verification du Nom en ajax
  function newsletter() {
    $.ajax({
      type: 'post',
      url: '../core/controller/verification.php?newsletter=newsletter',
      data: {
        'newsletter': $('#newsletter').val()
      },
      success: function (data) {
        if(data=='success'){
          $('#output_newsletter').show();
          $('#output_newsletter').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
          return true;
        }
        else{
          $('#output_newsletter').show();
          $('#output_newsletter').css({
            'color': 'red',
            'font-weight': 'bold',
            'margin': 'initial',
            'padding': 'initial',
            'font-size': '65%'
          }).html(data);

          setTimeout(function () {
            $('#output_newsletter').hide();

          }, 7000);
        }
      }
    });


  }



  $('#newsletters').submit(function () {
    var email_newsletter = $('#newsletter').val();
    var rapport = $('.rapport_newsletter');


    if (email_newsletter == '') {
      rapport.html("Veuillez remplir le champs vide").show();
    }
    else {
      var $form = $(this);
      var formdata = (window.FormData) ? new FormData($form[0]) : null;
      var donnee = (formdata !== null) ? formdata : $form.serialize();

      $.ajax({
        type: 'post',
        url: '../core/controller/submit.php?newsletter=newsletter',
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload
        data: donnee,
        beforeSend: function () {
          $('#enreg_newsletter').attr('value', 'En cours...');
          $('#load_data_newsletter').html('<div class="fa-2x" style="display: block;"><i class="fa fa-spinner fa-spin"></i></div>');
        },
        success: function (data) {
          if(data != 'success'){
            $('#enreg_newsletter').attr('value', 'Envoyer');
            $('#load_data_newsletter').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

            rapport.html(data).show();
          }
          else {
            $('#enreg_newsletter').attr('value', 'Envoyer');
            $('#load_data_newsletter').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

            rapport.html("Merci de Nous avoir fait Confiance !").show();

            setTimeout(function () {
              $('#output_newsletter').fadeOut().hide();
              rapport.html("Merci de Nous avoir fait Confiance !").hide();
            }, 7000);
          }
        }

      });

    }


  });



});



/* menu avec scroll horizontal*/
$(document).ready(function() {
  var marquee = $('div.marquee');
  console.log(marquee);
  marquee.each(function() {
    var mar = $(this),indent = mar.width();
    mar.marquee = function() {
      indent--;
      mar.css('text-indent',indent);
      if (indent < -1 * mar.children('div.marquee-text').width()) {
        indent = mar.width();
      }
    };
    mar.data('interval',setInterval(mar.marquee,1000/60));
  });
});


//slider pour les partenaires
$(document).ready(function(){
  $('.customer-logos').click({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: false,
    dots: false,
    pauseOnHover: false,
    responsive: [{
      breakpoint: 768,
      settings: {
        slidesToShow: 4
      }
    }, {
      breakpoint: 520,
      settings: {
        slidesToShow: 3
      }
    }]
  });
});


//vie associative
$(function () {
  $('.carousel-inner .carousel-item:first-child, .carousel-indicators .list-inline-item:first-child').addClass('active');
  $('.list-inline-item a:first-child').addClass('selected');
});


$(function () {
  var item = $('#myList a');
  var item1 = $('#myList a:first-child');
  item1.addClass('active');
  item.on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
  });
});


$(function () {

  const item = $('.list-group-item');
  const itemId = $('#myList .list-group-item:first-child');
  const violet = '#8A2BE2';
  const or = '#fcd21c';

  if(itemId.hasClass('active')){

    itemId.css({
      'z-index': '2',
      'color': '#fff',
      'background-color': violet,
      'border-color': or
    });

  }


  item.on({

    click: function () {

      item.each(function () {
        $('#myList a').css({
        'z-index': 1,
        'color': '#495057',
        'text-decoration': 'none',
        'background-color': '#f8f9fa'
        });
      });

      $('#myList a.active').css({
        'z-index': '2',
        'color': '#fff',
        'background-color': '#8A2BE2',
        'border-color': '#fcd21c'
      });

    }
  });


  //programme de formation
  for(let i=0; i<$('.box').length; i++){
    if(i%2===0){
      $(`div.box:eq(${i})`).addClass('featured');
      $(`div.box:eq(${i})`).attr('data-aos', 'fade-left');
    }else {
      $('div.box:eq(' + i + ')').attr('data-aos', 'fade-up');
    }
  }

  const pf = $('.pf');
  for(let i=0; i<pf.length; i++){
    if(i%2===0){

      $(`div.pf:eq(${i})`).addClass('pf2');
      $('.pf2').css({
        background: violet,
        'box-shadow': 'none',
        'border-radius': '8px',
        position: 'relative',
        overflow: 'hidden'
      });
      $(`.pf h3:eq(${i})`).css('color', '#fff');
    } else {
      pf.css({
        background: '#f3f1f0',
        'box-shadow': 'none',
        'border-radius': '8px',
        position: 'relative',
        overflow: 'hidden'
      });
      $(`.pf h3:eq(${i})`).css('color', violet);
    }
  }


  //VAE
  const item11 = $('ul.nav-tabs li.nav-item:first-child');
  item11.removeClass('mt-2');

  const item12 = $('ul.nav-tabs li.nav-item:first-child a:first-child');
  item12.addClass('active');
  item12.addClass('show');

  const item13 = $('.tab-content div.tab-pane:first-child');
  item13.addClass('active');
  item13.addClass('show');

});
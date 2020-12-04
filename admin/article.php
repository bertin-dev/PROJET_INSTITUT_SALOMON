<?php
require '../app/config/Config_Server.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="wysibb/src/css/wysiwyg.css" rel="stylesheet">
    <link href="wysibb/src/css/highlight.min.css" rel="stylesheet">


    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        #img-upload{
            width: 100%;
        }
    </style>

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Poster un Article!</h1>
                      <div class="alert alert-danger rapport" style="display:none;"></div>
                  </div>
                  <form class="user" role="form" id="form_article" enctype="multipart/form-data">
                      <div class="form-group">
                          <label class="my-1 mr-2" for="category_id">Selectionner une catégorie</label>
                          <select class="custom-select my-1 mr-sm-2" id="category_id" name="category_id" style="font-size: 15px!important;">
                              <?php
                              foreach (App::getDB()->query('SELECT id, title FROM categories ORDER BY id DESC') AS $menu):
                                  echo '<option value="' . $menu->id . '">' . $menu->title . '</option>';
                              endforeach;
                              ?>
                          </select>
                      </div>

                      <div class="form-group">
                          <label for="titre_article">Titre de votre article</label><input type="text" class="form-control" id="titre_article" name="titre_article" aria-describedby="titre_article" placeholder="Titre de l'article" required>
                      </div>


                      <div class="form-group"><label>Page de couverture</label>

                          <div class="col-lg-6">
                              <div class="input-group">
                                  <span class="input-group-btn">
                                  <span class="btn btn-default btn-file">Selectionner une image…
                                      <input type="file" id="imgInp" name="imgInp" required>
                                  </span>
                                  </span>
                                  <input type="text" class="form-control" readonly>
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <img id='img-upload'/>
                          </div>

                      </div>

                      <div class="form-group">
                          <label for="desc_article">Décrivez votre article</label>
                          <textarea name="desc_article" id="desc_article" class="form-control" cols="30" rows="10" required></textarea>
                      </div>

                    <hr>

                      <div class="form-group">
                          <input style="font-size: 15px" type="submit" class="btn btn-primary btn-user btn-block currentSend" value="Publier"/>
                          <center><img src="img/loader.gif" class="loader" style="display:none;" alt=""></center>
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

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="wysibb/src/js/wysiwyg.js"></script>
  <script src="wysibb/src/js/highlight.js"></script>
  <script type="text/javascript">
      $(document).ready(function () {
          $('#desc_article').wysiwyg({

          });
      });



      /* ==========================================================================
ADD ARTICLE
========================================================================== */

      const article = " Article"
      const result_article = "Veuillez inserer un titre à votre article"
      const success_msg = " publié avec succès.";
      const delete_msg = " Supprimé avec succès.";
      const update_msg = " Modifié avec succès."

      $(function() {

          $('#form_article input').focus(function () {
              $('.rapport').fadeOut(800);
          });

          $('#form_article').on('submit', function (e) {
              /* On empêche le navigateur de soumettre le formulaire*/
              e.preventDefault();
              //alert($('#editor').val());
              $('.loader').show();
              $('.currentSend').attr('value', 'En cours...');
              var $form = $(this);
              var formdata = (window.FormData) ? new FormData($form[0]) : null;
              var data = (formdata !== null) ? formdata : $form.serialize();

              $.ajax({
                  url: 'controllers/traitement.php?article=article',
                  type: 'post',
                  contentType: false, /* obligatoire pour de l'upload*/
                  processData: false, /* obligatoire pour de l'upload*/
                  dataType: 'html', /* selon le retour attendu*/
                  data: data,
                  success:function(data){
                      var cat = $('.rapport');
                      if(data === 'success'){
                          $('.loader').hide();
                          cat.removeClass('alert-danger');
                          cat.addClass('alert-success');
                          $('.currentSend').attr('value', 'Publier');
                          cat.html(article + ' ' + success_msg).show();
                          setTimeout(function () {
                              cat.html(article +' ' + success_msg).slideDown().hide();
                              $('body').load('article.php', function() {
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
                      $('#img-upload').attr('src', e.target.result);
                  }

                  reader.readAsDataURL(input.files[0]);
              }
          }

          $("#imgInp").change(function(){
              readURL(this);
          });
      });


  </script>

</body>

</html>

<?php require_once('page_number.php'); ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?= isset($_ENV['description']) ? $_ENV['description']:''; ?></h2>
          <ol>
            <li><a href="home.php">Home</a></li>
            <li><?= isset($_ENV['titre']) ? $_ENV['titre']:''; ?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section class="map-section">
        <div class="container">
            <div class="row">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.741878102138!2d9.790899714760037!3d4.0729222970383345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10610c14fd1033ff%3A0x87a32ab38f684bf!2sSITABAC!5e0!3m2!1sfr!2scm!4v1610410810214!5m2!1sfr!2scm" width="1366" height="568" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </section>

    <section id="contact" class="contact">
      <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

          <div class="col-lg-10">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="icofont-google-map"></i>
                  <h4>Location:</h4>
                  <p><?= isset($_ENV['localisation']) ? $_ENV['localisation']:''; ?></p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="icofont-envelope"></i>
                  <h4>Email:</h4>
                  <p><?= isset($_ENV['email']) ? $_ENV['email']:''; ?></p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="icofont-phone"></i>
                  <h4>Telephone:</h4>
                  <p><?= isset($_ENV['phone']) ? $_ENV['phone']:''; ?></p>
                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row mt-5 justify-content-center" data-aos="fade-up">
          <div class="col-lg-10">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form" id="contact_visitor" onsubmit="return false;">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="identite_visitor" class="form-control" id="identite_visitor" placeholder="Votre nom" data-rule="minlen:4" data-msg="S'il vous plait votre nom doit posseder au moins 4 charartères" />
                  <small id="output_identite_visitor" class="validate"></small>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email_visitor" id="email_visitor" placeholder="Votre Email" data-rule="email" data-msg="S'il vous plait veuillez inserer votre email" />
                  <div id="output_email_visitor" class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject_visitor" id="subject_visitor" placeholder="Entrez un objet" data-rule="minlen:4" data-msg="S'il vous plait votre objet doit posséder au moins 4 charactères" />
                <div id="output_subject_visitor" class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message_visitor" rows="5" data-rule="required" data-msg="S'il vous plaits Veuillez saisir votre message" placeholder="Entrez votre message"></textarea>
                <div id="output_message_visitor" class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Chargement Encours...</div>
                <div class="error-message"></div>
                <div class="sent-message">Votre message a bien été envoyé</div>
              </div>
              <div class="text-center"><button type="submit" id="enreg_visitor">Envoyer Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

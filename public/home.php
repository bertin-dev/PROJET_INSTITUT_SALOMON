<?php require_once('page_number.php');
define('MIN_CHARACTER1', 0);
define('MAX_CHARACTER1', 20);
?>


  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

      <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <?php
          $connexion = \App::getDB();
          $slide = '';
          foreach($connexion->query('SELECT id, titre, description, image FROM caroussel') as $retour):

              $img = isset($retour->image) ? str_replace('../../public/', ' ', $retour->image): 'assets/img/slide/slide-1.jpg';
              $img = str_replace('"', "", $img);


              $slide .= '<div class="carousel-item" style="background-image: url('.$img.');">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2>Welcome to <span>'.$retour->titre.'</span></h2>
              <p>'.$retour->description.'</p>
              <div class="text-center"><a href="" class="btn-get-started">Lire la Suite</a></div>
            </div>
          </div>
        </div>';

          endforeach;

          echo $slide;
          ?>


      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta" style="padding-top: 10px;padding-bottom: 10px">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 text-center text-lg-center">
            <h3 style="color: white;">BIENVENUE A <span>L'<?= isset($_ENV['nom_site']) ? $_ENV['nom_site']:'INSTITUT SALOMON'; ?></span></h3>
            <p style="color: white;"> Les inscriptions en continu tout au long de l'année.</p>
              <a class="cta-btn align-middle" href="#">TEL: <?= isset($_ENV['phone']) ? $_ENV['phone']:''; ?></a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->


    <section style="padding-top: 10px;padding-bottom: 10px">
      <div class="sp-module  jd-title">
          <h3 class="sp-module-title">Mode de Formation</h3>
          <div class="container">
              <div class="row">

                  <?php
                  foreach($connexion->query('SELECT libelle, description, img_url FROM formation
                                                      WHERE headers_id ="'.$_ENV['id_page'].'" LIMIT 2') as $retour):

                      $img = isset($retour->img_url) ? str_replace('../../public/', ' ', $retour->img_url): '';

                      echo '<div class="col-lg-6">
                      <div class="card mb-3" style="max-width: 540px;">
                          <div class="row no-gutters">
                              <div class="col-md-4">
                                  <img src="'.$img.'" class="card-img" alt="'.$retour->libelle.'" title="'.$retour->libelle.'">
                              </div>
                              <div class="col-md-8">
                                  <div class="card-body">
                                      <h5 class="card-title">'.$retour->libelle.'</h5>
                                      <p class="card-text">'.$retour->description.'</p>
                                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>';
                  endforeach;
                  ?>
              </div>
          </div>

      </div>
      </section>


      <!-- ======= Pricing Section ======= -->
      <div id="pricing" class="pricing-area area-padding">
          <div class="container">
              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="section-headline text-center">
                          <h2>Pricing Table</h2>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="pri_table_list">
                          <h3>basic <br /> <span>$80 / month</span></h3>
                          <ol>
                              <li class="check">Online system</li>
                              <li class="check cross">Full access</li>
                              <li class="check">Free apps</li>
                              <li class="check">Multiple slider</li>
                              <li class="check cross">Free domin</li>
                              <li class="check cross">Support unlimited</li>
                              <li class="check">Payment online</li>
                              <li class="check cross">Cash back</li>
                          </ol>
                          <button>sign up now</button>
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="pri_table_list active">
                          <span class="saleon">top sale</span>
                          <h3>standard <br /> <span>$110 / month</span></h3>
                          <ol>
                              <li class="check">Online system</li>
                              <li class="check">Full access</li>
                              <li class="check">Free apps</li>
                              <li class="check">Multiple slider</li>
                              <li class="check cross">Free domin</li>
                              <li class="check">Support unlimited</li>
                              <li class="check">Payment online</li>
                              <li class="check cross">Cash back</li>
                          </ol>
                          <button>sign up now</button>
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="pri_table_list">
                          <h3>premium <br /> <span>$150 / month</span></h3>
                          <ol>
                              <li class="check">Online system</li>
                              <li class="check">Full access</li>
                              <li class="check">Free apps</li>
                              <li class="check">Multiple slider</li>
                              <li class="check">Free domin</li>
                              <li class="check">Support unlimited</li>
                              <li class="check">Payment online</li>
                              <li class="check">Cash back</li>
                          </ol>
                          <button>sign up now</button>
                      </div>
                  </div>
              </div>
          </div>
      </div><!-- End Pricing Section -->


      <!-- ======= Programmes de formation ======= -->
      <section id="pricing" class="pricing" style="padding-top: 10px;padding-bottom: 10px">
          <div class="sp-module  jd-title">
              <h3 class="sp-module-title">NOS PROGRAMMES</h3>
          </div>
          <div class="container">
              <div class="row">
                  <?php
                  $connexion = \App::getDB();
                  foreach($connexion->query('SELECT formation.id, formation.libelle AS fLbl, formation.description AS fDesc, 
                                                             formation.prix AS fPrix, formation.etat AS fEtat, formation.frequence_paiement_id, formation.module_id, 
                                                             formation.img_url AS fImg_url, formation.headers_id, formation.created_at, 
                                                             formation.updated_at, fp.id, fp.libelle AS fpLbl, m.id, m.libelle AS mLbl, 
                                                             m.description AS mDesc, m.frequence_paiement_id, m.prix AS mPrix, m.duree AS mDuree, m.created_at,
                                                             m.updated_at 
                                                      FROM formation
                                                      INNER JOIN frequence_paiement fp 
                                                      ON fp.id = formation.frequence_paiement_id
                                                      INNER JOIN module m 
                                                      ON formation.module_id = m.id
                                                      WHERE headers_id="'.$_ENV['id_page'].'"
                                                      ORDER BY formation.id DESC 
                                                      LIMIT 3 
                                                      ') as $retour):

                      echo '<div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                          <div class="col-8 offset-2 text-center pf" data-aos="fade-up">
                          <h3 style="margin-bottom: initial;" title="'.$retour->mDesc.'">'.$retour->mLbl.'</h3></div>
                      <div class="box" data-aos="fade-right" style="border-radius: 58px;">
                          <h4>'.$retour->mPrix.'<sub>Fcfa</sub><span> / ';
                      if(intval($retour->mDuree)==0)
                          echo '';
                      else
                          echo $retour->mDuree;

                      echo ' '.$retour->fpLbl.'</span></h4>
                          <ul>
                              <li title="'.$retour->fDesc.'">'.$retour->fLbl.'</li>
                          </ul>
                          <!--<div class="btn-wrap">
                              <a href="#" class="btn-buy">Buy Now</a>
                          </div>-->
                      </div>
                  </div>';
                  endforeach;
                  ?>
              </div>

          </div>
      </section><!-- End Pricing Section -->


    <section id="" class="" style="padding-top: 10px;padding-bottom: 10px">
          <div class="sp-module  jd-title">
              <h3 class="sp-module-title">VIE ASSOCIATIVE</h3>
          </div>
          <div class="container">
              <div class="row">
                  <div class="col-lg-6">
                      <div class="row align-items-center">
                          <div class="col-lg-12" id="slider">
                              <div id="myCarousel" class="carousel slide shadow" data-ride="carousel">
                                  <!-- main slider carousel items -->
                                  <div class="carousel-inner">

                                      <?php
                                      foreach($connexion->query('SELECT id, url_miniature, url FROM images
                                                      WHERE vie_ass_id=1') as $retour):

                                          $img = isset($retour->url) ? str_replace('../../public/', ' ', $retour->url): 'assets/img/slide/slide-1.jpg';

                                          echo ' <div class="carousel-item" data-slide-number="'.$retour->id.'">
                                          <img src="'.$img.'" class="img-fluid">
                                                </div>';
                                      endforeach;
                                      ?>

                                      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                          <span class="sr-only">Previous</span>
                                      </a>
                                      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="sr-only">Next</span>
                                      </a>

                                  </div>
                                  <!-- main slider carousel nav controls -->


                                  <ul class="carousel-indicators list-inline mx-auto border px-2">

                                      <?php
                                      foreach($connexion->query('SELECT id, url_miniature, url FROM images
                                                      WHERE vie_ass_id=1') as $retour):

                                         $img_miniature = isset($retour->url_miniature) ? str_replace('../../public/', ' ', $retour->url_miniature): 'assets/img/slide/slide-1.jpg';

                                          echo '<li class="list-inline-item">
                                          <a id="carousel-selector-'.$retour->id.'" data-slide-to="'.$retour->id.'" data-target="#myCarousel">
                                              <img src="'.$img_miniature.'" class="img-fluid">
                                          </a>
                                            </li>';
                                      endforeach;
                                      ?>
                                  </ul>
                              </div>
                          </div>

                      </div>
                      <!--/main slider carousel-->
                  </div>
                  <div class="col-lg-6">
                      <h5 class="text-center"><small><strong>Vivre l’association, c’est construire votre réseau</strong></small></h5>
                      <div class="list-group" id="myList">
                      <?php
                      foreach ($connexion->query('SELECT id, libelle, description FROM vie_ass
                                                      WHERE headers_id='.$_ENV['id_page']) as $retour):

                          echo '<a href="#" class="list-group-item list-group-item-action">
                              <div class="d-flex w-100 justify-content-between">
                                  <h5 class="mb-1"><small>'.$retour->libelle.'</small></h5>
                              </div>
                              <small>'.$retour->description.'</small>
                          </a>';
                      endforeach;
                      ?>
                      </div>
                      <h5 class="text-center"><small><strong>Rejoignez des dizaines de professionnels</strong></small></h5>
                  </div>
              </div>
          </div>
      </section>


      <!-- ======= Features Section ======= -->
    <section id="features" class="features" style="padding-top: 10px;padding-bottom: 10px">
          <div class="sp-module  jd-title">
              <h3 class="sp-module-title">VALORISATION DES ACQUIS DE L'EXPERIENCE</h3>
          </div>
          <div class="container">

              <div class="row">
                  <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-right">
                      <ul class="nav nav-tabs flex-column">
                          <?php
                          foreach ($connexion->query('SELECT id, libelle, description FROM vae
                                                      WHERE vae_etat ="1"') as $retour):

                              echo '<li class="nav-item mt-2">
                              <a class="nav-link" data-toggle="tab" href="#tab-'.$retour->id.'">
                                  <h4>'.$retour->libelle.'</h4>
                                  <p>'.$retour->description.'</p>
                              </a>
                          </li>';

                          endforeach;
                          ?>
                          <!--<li class="nav-item">
                              <a class="nav-link active show" data-toggle="tab" href="#tab-1">
                                  <h4>Modi sit est</h4>
                                  <p>Quis excepturi porro totam sint earum quo nulla perspiciatis eius.</p>
                              </a>
                          </li>
                          <li class="nav-item mt-2">
                              <a class="nav-link" data-toggle="tab" href="#tab-2">
                                  <h4>Unde praesentium sed</h4>
                                  <p>Voluptas vel esse repudiandae quo excepturi.</p>
                              </a>
                          </li>
                          <li class="nav-item mt-2">
                              <a class="nav-link" data-toggle="tab" href="#tab-3">
                                  <h4>Pariatur explicabo vel</h4>
                                  <p>Velit veniam ipsa sit nihil blanditiis mollitia natus.</p>
                              </a>
                          </li>
                          <li class="nav-item mt-2">
                              <a class="nav-link" data-toggle="tab" href="#tab-4">
                                  <h4>Nostrum qui quasi</h4>
                                  <p>Ratione hic sapiente nostrum doloremque illum nulla praesentium id</p>
                              </a>
                          </li>-->
                      </ul>
                  </div>
                  <div class="col-lg-7 ml-auto" data-aos="fade-left" data-aos-delay="100">
                      <div class="tab-content">
                          <?php
                          foreach ($connexion->query('SELECT id, libelle, img_url FROM vae
                                                      WHERE vae_etat ="1"') as $retour):
                              $img = isset($retour->img_url) ? str_replace('../../public/', ' ', $retour->img_url) : '';
                              echo '<div class="tab-pane" id="tab-'.$retour->id.'">
                              <figure>
                                  <img src="'.$img.'" alt="'.$retour->libelle.'" title="'.$retour->libelle.'" class="img-fluid">
                              </figure>
                          </div>
                          ';

                          endforeach;
                          ?>
                          <!--<div class="tab-pane active show" id="tab-1">
                              <figure>
                                  <img src="assets/img/features-1.png" alt="" class="img-fluid">
                              </figure>
                          </div>
                          <div class="tab-pane" id="tab-2">
                              <figure>
                                  <img src="assets/img/features-2.png" alt="" class="img-fluid">
                              </figure>
                          </div>
                          <div class="tab-pane" id="tab-3">
                              <figure>
                                  <img src="assets/img/features-3.png" alt="" class="img-fluid">
                              </figure>
                          </div>
                          <div class="tab-pane" id="tab-4">
                              <figure>
                                  <img src="assets/img/features-4.png" alt="" class="img-fluid">
                              </figure>
                          </div>-->
                      </div>
                  </div>
              </div>

          </div>
      </section><!-- End Features Section -->


      <!-- ======= Popular Courses Section ======= -->
      <section id="popular-courses" class="courses">
          <div class="container" data-aos="fade-up">

              <div class="sp-module  jd-title">
                  <h3 class="sp-module-title">ACTUALITE <strong>INSTITUT SALOMON</strong></h3>
              </div>

              <div class="row" data-aos="zoom-in" data-aos-delay="100">

                  <?php
                  foreach (App::getDB()->query('SELECT posts.id AS id_posts, posts.title AS post_title, content, post_type, likes, dislike, favourited, posts.created_at,
                                                            user_id, category_id, images.id AS id_images, url_miniature, url, u.first_name, u.last_name, u.avatar, c.title AS cat_title
                                                        FROM posts
                                                        INNER JOIN images
                                                        ON posts.id=images.post_id
                                                        INNER JOIN categories c 
                                                        ON posts.category_id = c.id
                                                        INNER JOIN users u 
                                                        ON posts.user_id = u.id
                                                        ORDER BY posts.id DESC LIMIT 3') as $retour):

                      echo '<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                      <div class="course-item">
                          <img src="' . str_replace('../../public/', '', $retour->url) . '" alt="' . $retour->post_title . '" title="' . $retour->post_title . '" class="img-fluid">
                          <div class="course-content">
                              <div class="d-flex justify-content-between align-items-center mb-3">
                                  <h4>'.$retour->cat_title.'</h4>
                                  <p class="text-info"><time class="timeago" datetime="' . date('c', strtotime($retour->created_at)) . '">' . date('j F Y à H:m', strtotime($retour->created_at)) . '</time></p>
                              </div>

                              <h3><a href="course-details.html">'.$retour->post_title.'</a></h3>
                              <p>'. substr(htmlspecialchars_decode($retour->content), MIN_CHARACTER1, MAX_CHARACTER1).'</p>
                              <a href="index.php?id_page=8&posts_id='.$retour->id_posts.'" title="'.$retour->post_title.'">Lire la suite</a>
                              
                              <div class="trainer d-flex justify-content-between align-items-center">
                                  <div class="trainer-profile d-flex align-items-center">';
                             $img = !empty($retour->avatar) ? str_replace('../../public/', ' ', $retour->avatar) : 'assets/img/profil.png';
                                      echo '<img src="'.$img.'" title="'.$retour->first_name.'" class="img-fluid">
                                      <span>'.$retour->first_name.'</span>
                                  </div>
                                  <div class="trainer-rank d-flex align-items-center">
                                      <i class="icofont-comment"></i>&nbsp;';

                      $result = App::getDB()->rowCount('SELECT comments.id AS id_comments, comments.content, comments.created_at, users.first_name, users.last_name FROM posts
                            INNER JOIN comments
                            ON posts.id=comments.post_id
                            INNER JOIN users
                            ON users.id=comments.user_id
                            WHERE posts.id=' . $retour->id_posts);

                      echo $result;

                      echo '&nbsp;&nbsp;
                                    
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>';
                  endforeach;
                  ?>

                  <!--  <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                       <div class="course-item">
                           <img src="assets/img/course-2.jpg" class="img-fluid" alt="...">
                           <div class="course-content">
                               <div class="d-flex justify-content-between align-items-center mb-3">
                                   <h4>Marketing</h4>
                                   <p class="price">$250</p>
                               </div>

                               <h3><a href="course-details.html">Search Engine Optimization</a></h3>
                               <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
                               <div class="trainer d-flex justify-content-between align-items-center">
                                   <div class="trainer-profile d-flex align-items-center">
                                       <img src="assets/img/trainers/trainer-2.jpg" class="img-fluid" alt="">
                                       <span>Lana</span>
                                   </div>
                                   <div class="trainer-rank d-flex align-items-center">
                                       <i class="bx bx-user"></i>&nbsp;35
                                       &nbsp;&nbsp;
                                       <i class="bx bx-heart"></i>&nbsp;42
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                       <div class="course-item">
                           <img src="assets/img/course-3.jpg" class="img-fluid" alt="...">
                           <div class="course-content">
                               <div class="d-flex justify-content-between align-items-center mb-3">
                                   <h4>Content</h4>
                                   <p class="price">$180</p>
                               </div>

                               <h3><a href="course-details.html">Copywriting</a></h3>
                               <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
                               <div class="trainer d-flex justify-content-between align-items-center">
                                   <div class="trainer-profile d-flex align-items-center">
                                       <img src="assets/img/trainers/trainer-3.jpg" class="img-fluid" alt="">
                                       <span>Brandon</span>
                                   </div>
                                   <div class="trainer-rank d-flex align-items-center">
                                       <i class="bx bx-user"></i>&nbsp;20
                                       &nbsp;&nbsp;
                                       <i class="bx bx-heart"></i>&nbsp;85
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div> -->

              </div>

          </div>
      </section><!-- End Popular Courses Section -->

      <!-- ======= Our Team Section ======= -->
    <section id="team" class="team" style="padding-top: 10px;padding-bottom: 10px">
          <div class="sp-module  jd-title">
              <h3 class="sp-module-title">EQUIPE <strong>PEDAGOGIQUE</strong></h3>
          </div>
          <div class="container">

              <div class="row">

                  <?php
                  foreach ($connexion->query('SELECT id, first_name, last_name, profession, email, twitter, 
                                                       facebook, instagram, linkedin, user_type, liked_posts, 
                                                       disliked_posts, favourites, favourite_categories, 
                                                       preference, created_at, updated_at, avatar, newsletter_id,
                                                       objet, message, ip FROM users
                                                      WHERE user_type="0"') as $retour):
                      $img = isset($retour->avatar) ? str_replace('../../public/', ' ', $retour->avatar): '';

                      echo '<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                      <div class="member" data-aos="fade-up">
                          <div class="member-img">
                              <img src="'.$img.'" class="img-fluid" alt="'.$retour->first_name.' '.$retour->last_name.'" title="'.$retour->first_name.' '.$retour->last_name.'">
                              <div class="social">
                                  <a href="'.$retour->email.'"><i class="icofont-email"></i></a>
                                  <a href="'.$retour->twitter.'"><i class="icofont-twitter"></i></a>
                                  <a href="'.$retour->facebook.'"><i class="icofont-facebook"></i></a>
                                  <a href="'.$retour->instagram.'"><i class="icofont-instagram"></i></a>
                                  <a href="'.$retour->linkedin.'"><i class="icofont-linkedin"></i></a>
                              </div>
                          </div>
                          <div class="member-info">
                              <h4>'.$retour->first_name.' '.$retour->last_name.' </h4>
                              <span>'.$retour->profession.'</span>
                          </div>
                      </div>
                  </div>';
                  endforeach;
                  ?>

              </div>

          </div>
      </section><!-- End Our Team Section -->


      <!-- ======= Our Clients Section ======= -->
    <section id="clients" class="clients" style="padding-top: 10px;padding-bottom: 10px">
          <div class="sp-module  jd-title">
              <h3 class="sp-module-title">NOS PARTENAIRES</h3>
          </div>
          <div class="container">
              <div class="row">
                  <section class="customer-logos slider" style="padding-top: 10px; padding-bottom: 30px">
                      <?php
                      foreach ($connexion->query('SELECT id, name, img_url FROM partenaires') as $retour):

                          $img = isset($retour->img_url) ? str_replace('../../public/', ' ', $retour->img_url): '';

                      echo '<div class="slide"><img src="'.$img.'" title="'.$retour->name.'" alt="'.$retour->name.'" class="img-fluid" ></div>';
                      endforeach;
                      ?>
                  </section>
              </div>
          </div>
      </section>

  </main><!-- End #main -->


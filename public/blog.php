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

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        <div class="row">

          <div id="articles" class="col-lg-8 entries">
              <?php
              $nombreDeMessagesParPage = 5; // Essayez de changer ce nombre pour voir :o)
              $pages = 1; // On se met sur la page 1 (par défaut)
              // On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
              $premierMessageAafficher = ($pages - 1) * $nombreDeMessagesParPage;

              $post = App::getDB()->compteur_start_end('SELECT posts.id AS id_posts, title, content, post_type, likes, dislike, favourited, posts.created_at,
                                                            user_id, category_id, images.id AS id_images, url_miniature, url FROM posts
                                                     INNER JOIN images
                                                     ON posts.id=images.post_id
                                                     ORDER BY posts.id DESC LIMIT :offset , :limit');
              $post->bindParam(':offset', $premierMessageAafficher , PDO::PARAM_INT);
              $post->bindParam(':limit', $nombreDeMessagesParPage, PDO::PARAM_INT);
              $post->execute();
              while ($post_item = $post->fetch()) {
                  ?>

                  <article class="entry" data-aos="fade-up">

                      <div class="entry-img">
                          <?php
                          $myImg = str_replace('../../public/', '', $post_item['url']);
                          ?>
                          <img src="<?=$myImg;?>" alt="<?=$post_item['title'];?>" title="<?=$post_item['title'];?>" class="img-fluid">
                      </div>

                      <h2 class="entry-title">
                          <a data="articles=<?=$post_item['id_posts'];?>" href="#" class="link_articles"><?=$post_item['title'];?></a>
                      </h2>

                      <div class="entry-meta">
                          <ul>
                              <li class="d-flex align-items-center"><i class="icofont-user"></i> <a data="articles=<?=$post_item['id_posts'];?>" href="#" onclick="return false;">John Doe</a></li>
                              <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a data="articles=<?=$post_item['id_posts'];?>" href="#" onclick="return false;"><time datetime="2020-01-01"><?=date('F j, Y', strtotime($post_item['created_at']));?></time></a></li>
                              <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a data="articles=<?=$post_item['id_posts'];?>" href="#" onclick="return false;">
                                      <?php
                                      $result = App::getDB()->rowCount('SELECT comments.id AS id_comments, comments.content, comments.created_at, users.first_name, users.last_name FROM posts
                            INNER JOIN comments
                            ON posts.id=comments.post_id
                            INNER JOIN users
                            ON users.id=comments.user_id
                            WHERE posts.id='. $post_item['id_posts']);
                                      if(intval($result) == 0)
                                          echo  $result .' Commentaire';
                                      elseif (intval($result) == 1)
                                          echo $result . ' Commentaire';
                                      else
                                          echo $result . ' Commentaires';
                                      ?>
                                  </a></li>
                          </ul>
                      </div>

                      <div class="entry-content">
                          <p>
                              <?=substr(htmlspecialchars_decode($post_item['content']), MIN_CHARACTER, MAX_CHARACTER) ?>
                          </p>
                          <div class="read-more">
                              <a data="articles=<?=$post_item['id_posts'];?>" tabindex="-1" class="link_articles" href="#" title="Lire la suite">Lire la Suite</a>
                          </div>
                      </div>

                  </article><!-- End blog entry -->

              <?php
              }
              ?>

            <article class="entry" data-aos="fade-up">

              <div class="entry-img">
                <img src="assets/img/blog-4.jpg" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="blog-single.php">Non rem rerum nam cum quo minus. Dolor distinctio deleniti explicabo eius exercitationem. Veniam eius velit ab ipsa quidem rem.</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.php">John Doe</a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.php"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.php">12 Comments</a></li>
                </ul>
              </div>

              <div class="entry-content">
                <p>
                  Aspernatur rerum perferendis et sint. Voluptates cupiditate voluptas atque quae. Rem veritatis rerum enim et autem. Saepe atque cum eligendi eaque iste omnis a qui.
                  Quia sed sunt. Ea asperiores expedita et et delectus voluptates rerum. Id saepe ut itaque quod qui voluptas nobis porro rerum. Quam quia nesciunt qui aut est non omnis. Inventore occaecati et quaerat magni itaque nam voluptas. Voluptatem ducimus sint id earum ut nesciunt sed corrupti nemo.
                </p>
                <div class="read-more">
                  <a href="blog-single.php">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->

            <!--<div class="blog-pagination">
              <ul class="justify-content-center">
                <li class="disabled"><i class="icofont-rounded-left"></i></li>
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#"><i class="icofont-rounded-right"></i></a></li>
              </ul>
            </div>-->

              <?php
              $totalDesMessages = App::getDB()->rowCount('SELECT posts.id AS id_posts, title, content, post_type, likes, dislike, favourited, posts.created_at,
                                                            user_id, category_id, images.id AS id_images, url_miniature, url FROM posts
                                                     INNER JOIN images
                                                     ON posts.id=images.post_id
                                                     ORDER BY posts.id DESC');
              // On calcule le nombre de pages à créer
              $nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
              // Puis on fait une boucle pour écrire les liens vers chacune des pages
              echo '<div class="blog-pagination">
                    <ul class="justify-content-center">
                    <li class="disabled"><i class="icofont-rounded-left"></i></li>';
              /* Boucle sur les pages */
              for ($i = 1 ; $i <= $nombreDePages ; $i++) {
                  if ($i < ($pages-3) )
                      $i = $pages - 3;
                  if ($i >= $pages + 3 AND $i <= $nombreDePages - 3)
                      echo "...";
                  if ($i > ($pages+2) )
                      $i = $nombreDePages ;
                  if ($i == $pages )
                      echo '<li class="active"><a href="#">'.$i.'</a></li>';
                  else
                      echo '<li class="page"><a data="pages='.$i.'&MessagesParPage='.$nombreDeMessagesParPage.'" href="#" class="pagination_link" data-title="page '.$i.'">'.$i.'</a></li>';
              }
              echo '
              <li>
              <a class="pagination_link" data="pages=';
              if($i==1)
                  echo $i;
              else
                  echo ($i-1);
              echo '&MessagesParPage='.$nombreDeMessagesParPage.'" href="#" class="pagination_link" title="Suivant"><i class="icofont-rounded-right"></i></a></li>
              </ul>
              </div>';
              ?>

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

              <?php require 'blog_sidebar.php';?>

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

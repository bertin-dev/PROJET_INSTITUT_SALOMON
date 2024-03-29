<?php

require '../../app/config/Config_Server.php';
session_start();
$connexion = App::getDB();
define('MIN_CHARACTER', 0);
define('MAX_CHARACTER', 500);


function nettoieProtect(){

    foreach($_POST as $k => $v){
        $v=strip_tags(trim($v));
        $_POST[$k]=$v;
    }

    foreach($_GET as $k => $v){
        $v=strip_tags(trim($v));
        $_GET[$k]=$v;
    }

    foreach($_REQUEST as $k => $v){
        $v=strip_tags(trim($v));
        $_REQUEST[$k]=$v;
    }

}


/* ==========================================================================
SYSTEME DE VERIFICATION DE LA SECTION COMMENTAIRES
   ========================================================================== */

if (isset($_GET['comment'])) {

    if (isset($_POST['name'])) {

        extract($_POST);
        $name = preg_replace('#[^a-z0-9]#i', '', $name); //filter everything

        if (strlen($name) < 4 || strlen($name) > 16) {
            echo 'Le Nom est compris entre 3 et 16 caractères';
            exit;
        }

        if (is_numeric($name[0])) {
            echo 'Le Nom doit commencer par une lettre';
            exit;
        }

        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id FROM users WHERE first_name ="' . $name . '"');
        if ($nbre > 0) {
            echo '<br> Ce Nom est déjà utilisé s\'il vous plait veuillez vous inscrire';
            exit;
        } else {
            echo 'success';
        }
    }


    if (isset($_POST['email'])) {

        extract($_POST);

        if (strlen($_POST['email']) < 4 || strlen($_POST['email']) > 20) {
            echo 'L\'adresse Email est compris entre 3 et 16 caractères<br>';
            exit;
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { //Validation d'une adresse de messagerie.
            echo 'Votre Adresse E-mail n\'est pas valide<br>';
            exit();
        }

        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id  FROM users WHERE email="' . $_POST['email'] . '"');
        if ($nbre > 0) {
            echo 'Cet Email est déjà utilisé<br>';
            exit;
        } else {
            echo 'success';
        }
    }


    if (isset($_POST['comment'])) {

        extract($_POST);
        $message_visitor = preg_replace('#[^a-z0-9]#i', '', $comment); //filter everything

        if (strlen($comment) < 10 || strlen($comment) > 1000) {
            echo 'Le Message est compris entre 10 et 1000 caractères';
            exit;
        }

        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id FROM comments WHERE content="' . $comment . '"');
        if ($nbre > 0) {
            echo '<br> Ce Message est déjà utilisé';
            exit;
        } else {
            echo 'success';
        }
    }
}


/* ==========================================================================
SYSTEME DE GESTION DES ARTICLES CLIQUES PAR L'UTILISATEUR
========================================================================== */

if (isset($_POST['articles_click'])) {
    $resultat = '';

    foreach ($connexion->query('SELECT posts.id AS id_posts, title, content, post_type, likes, dislike, favourited, posts.created_at,
                                                            user_id, category_id, images.id AS id_images, url_miniature, url, 
                                                            u.first_name, u.last_name, u.linkedin, u.instagram, u.facebook, u.twitter,
                                                            u.email, u.avatar, u.profession
                                         FROM posts
                                         INNER JOIN images
                                         ON posts.id=images.post_id
                                         INNER JOIN users u 
                                         ON posts.user_id = u.id
                                         WHERE posts.id="' . intval($_POST['articles_click']) . '" ORDER BY id_posts DESC') as $post):

        $resultat .= '<article class="entry entry-single" data-aos="fade-up">

              <div class="entry-img">
              <img src="' . str_replace('../../public/', '', $post->url) . '" alt="' . $post->title . '" title="' . $post->title . '" class="img-fluid">        
              </div>

              <h2 class="entry-title">
                <a data="articles=' . $post->id_posts . '" href="#" class="link_articles">' . $post->title . '</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-user"></i> <a data="articles=' . $post->id_posts . '" href="#" onclick="return false;">' . $post->first_name . ' ' . $post->last_name . '</a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a data="articles=' . $post->id_posts . '" href="#" onclick="return false;">
                  <time class="timeago" datetime="' . date('c', strtotime($post->created_at)) . '">' . date('j F Y à H:m', strtotime($post->created_at)) . '</time></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i><a data="articles=' . $post->id_posts . '" href="#" onclick="return false;">';


        $result = $connexion->rowCount('SELECT comments.id AS id_comments, comments.content, comments.created_at, users.first_name, users.last_name FROM posts
                                               INNER JOIN comments
                                               ON posts.id=comments.post_id
                                               INNER JOIN users
                                               ON users.id=comments.user_id
                                               WHERE posts.id=' . $post->id_posts);
        if (intval($result) == 0)
            $resultat .= $result . ' Commentaire';
        elseif (intval($result) == 1)
            $resultat .= $result . ' Commentaire';
        else
            $resultat .= $result . ' Commentaires';


        $resultat .= '</a></li>
                </ul>
              </div>

              <div class="entry-content overflow-auto">
                <p>' . htmlspecialchars_decode($post->content) . '</p>

              </div>

              <div class="entry-footer clearfix">
                <div class="float-left">
                  <i class="icofont-tags"></i>
                  <ul class="tags">';
        foreach (App::getDB()->query('SELECT tags.title AS titre FROM posts_tags 
                                                   INNER JOIN tags
                                                   ON posts_tags.tag_id=tags.id
                                                   INNER JOIN posts
                                                   ON posts_tags.post_id=posts.id
                                                   WHERE posts.id=' . $_POST['articles_click']) as $tag):
            $resultat .= '<li><a href="#" onclick="return false;">' . $tag->titre . '</a></li>';
        endforeach;

        $resultat .= '</ul>
                </div>

                <div class="float-right share">
                  <a href="" title="Share on Twitter"><i class="icofont-twitter"></i></a>
                  <a href="" title="Share on Facebook"><i class="icofont-facebook"></i></a>
                  <a href="" title="Share on LinkedIn"><i class="icofont-linkedin"></i></a>
                </div>

              </div>

            </article><!-- End blog entry -->
            ';
        $img = isset($retour->avatar) ? str_replace('../../public/', ' ', $retour->avatar) : 'assets/img/profil.png';
        $resultat .= '<div class="blog-author clearfix" data-aos="fade-up">
              <img src="' . $img . '" class="rounded-circle float-left" alt="">
              <h4>' . $post->first_name . ' ' . $post->last_name . '</h4>
              <div class="social-links">
                <a href="' . $post->linkedin . '"><i class="icofont-linkedin"></i></a>
                <a href="' . $post->twitter . '"><i class="icofont-twitter"></i></a>
                 <a href="' . $post->facebook . '"><i class="icofont-facebook"></i></a>
                 <a href="' . $post->instagram . '"><i class="icofont-instagram"></i></a>
              </div>
            </div><!-- End blog author bio -->



              <!--COMMENTAIRES-->

            <div class="blog-comments" data-aos="fade-up">

              <h4 class="comments-count">';

        $result = $connexion->rowCount('SELECT comments.id AS id_comments, comments.content, comments.created_at, users.first_name, users.last_name FROM posts
                                               INNER JOIN comments
                                               ON posts.id=comments.post_id
                                               INNER JOIN users
                                               ON users.id=comments.user_id
                                               WHERE posts.id=' . $post->id_posts);
        if (intval($result) == 0)
            $resultat .= $result . ' Commentaire';
        elseif (intval($result) == 1)
            $resultat .= $result . ' Commentaire';
        else
            $resultat .= $result . ' Commentaires';


        $resultat .= '</h4>';


        foreach ($connexion->query('  SELECT comments.id AS id_comments, comments.content, comments.created_at, users.first_name, users.last_name, avatar 
                                               FROM posts
                                               INNER JOIN comments
                                               ON posts.id=comments.post_id
                                               INNER JOIN users
                                               ON users.id=comments.user_id
                                               WHERE comments.post_id ="' . intval($_POST['articles_click']) . '" ORDER BY id_comments DESC') as $comment):

            $resultat .= '<div id="comment-' . $comment->id_comments . '" class="comment clearfix">';
            if ($comment->avatar == '')
                $resultat .= '<img src="assets/img/profil3.png" class="comment-img  float-left" alt="">';
            else
                $resultat .= '<img src="' . str_replace('../../public/', '', $comment->avatar) . '" class="comment-img  float-left" alt="">';
            $resultat .= '<h5><a href="">' . $comment->last_name . ' ' . $comment->first_name . '</a> <a data="' . $comment->id_comments . '" onclick="return false;" data-toggle="collapse" data-target="#commentaire-reponses' . $comment->id_comments . '" href="#" class="reply"><i class="icofont-reply"></i> Repondre</a></h5>';

            $datetimeFormat = 'Y-m-d H:i:s';
            $date = new \DateTime();
            $date->setTimestamp($comment->created_at);
            $date_comment = $date->format($datetimeFormat);
            $date_comment = date('c', strtotime($date_comment));


            $resultat .= '<time class="timeago" datetime="' . $date_comment . '">' . date('j F Y à H:i', strtotime($date_comment)) . '</time>
                <p>' . htmlspecialchars_decode(nl2br($comment->content)) . '</p>';

            $resultat .= '<div id="commentaire-reponses' . $comment->id_comments . '" class="reply-form collapse">
                    <h4>Répondre un commentaire</h4>
                    <div id="rapport_comment' . $comment->id_comments . '" class="alert alert-danger rapport_response_comment" style="display:none;"></div>
                    <form id="form_comment' . $comment->id_comments . '" action="forms/contact.php" role="form" class="php-email-form" onsubmit="return false;">
                        <div class="row">
                            <input type="hidden" name="post_id' . $comment->id_comments . '" value="' . $_POST['articles_click'] . '">
                            <div class="col-md-6 form-group">
                                <input data="' . $comment->id_comments . '" id="name' . $comment->id_comments . '" name="name' . $comment->id_comments . '" type="text" class="form-control" placeholder="Votre Nom*" data-rule="minlen:4" data-msg="s\'il vous veuillez entrer au moins 4 charactères">
                                <small id="validate_name' . $comment->id_comments . '" class="validate"></small>
                            </div>
                            <div class="col-md-6 form-group">
                                <input data="' . $comment->id_comments . '" id="email' . $comment->id_comments . '" name="email' . $comment->id_comments . '" type="email" class="form-control" placeholder="Votre Email*" data-rule="email" data-msg="s\'il vous plait veuillez entrer un email valid">
                                <small id="validate_email' . $comment->id_comments . '" class="validate"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <textarea data="' . $comment->id_comments . '" id="comment' . $comment->id_comments . '" name="comment' . $comment->id_comments . '" class="form-control" placeholder="Votre commentaire*" data-rule="required" data-msg="S\'il vous plait veuiller entrer quelques"></textarea>
                                <small id="validate_comment' . $comment->id_comments . '" class="validate"></small>
                            </div>
                        </div>
                        <button data="' . $comment->id_comments . '" type="submit" class="btn btn-primary currentSend' . $comment->id_comments . '">Poster Commentaire</button>
                        <center><img src="../admin/img/loader.gif" class="loader" style="display:none;"></center>
                    </form>

                </div>';

            foreach ($connexion->query('SELECT comments_reply.id AS id_comments_reply, comments_reply.content, comments_reply.created_at, users.first_name, users.last_name, avatar, comments_reply.comments_id 
                                               FROM comments
                                               INNER JOIN comments_reply
                                               ON comments.id=comments_reply.comments_id
                                               INNER JOIN users
                                               ON users.id=comments_reply.user_id
                                               WHERE comments_reply.comments_id  ="' . intval($comment->id_comments) . '" ORDER BY id_comments_reply DESC') as $reply):

                $resultat .= '<div id="comment-reply-' . $reply->id_comments_reply . '" class="comment comment-reply clearfix">';
                if ($comment->avatar == '')
                    $resultat .= '<img src="assets/img/profil3.png" class="comment-img  float-left" alt="">';
                else
                    $resultat .= '<img src="' . str_replace('../../public/', '', $comment->avatar) . '" class="comment-img  float-left" alt="">';
                $resultat .= '<h5><a href="">' . $reply->last_name . ' ' . $reply->first_name . '</a></h5>';
                $datetimeFormat = 'Y-m-d H:i:s';
                $date = new \DateTime();
                $date->setTimestamp($reply->created_at);
                $date_comment = $date->format($datetimeFormat);
                $date_comment = date('c', strtotime($date_comment));
                $resultat .= '<time class="timeago" datetime="' . $date_comment . '">' . date('j F Y à H:i', strtotime($date_comment)) . '</time>';

                $resultat .= '<p>' . nl2br($reply->content) . '</p>

                </div><!-- End comment reply #1-->';

            endforeach;


            $resultat .= '</div><!-- End comment #1 -->';

        endforeach;

        $resultat .= '<div class="reply-form">
                    <h4>Commenter</h4>
                    <div class="alert alert-danger rapport_comment" style="display:none;"></div>
                    <form id="form_comment" action="" role="form" class="php-email-form" onsubmit="return false;">
                        <div class="row">
                            <input type="hidden" name="post_id" value="' . $_POST['articles_click'] . '">
                            <div class="col-md-6 form-group">
                                <input id="name" name="name" type="text" class="form-control" placeholder="Votre Nom*" data-rule="minlen:4" data-msg="s\'il vous veuillez entrer au moins 4 charactères">
                                <small id="validate_name" class="validate"></small>
                            </div>
                            <div class="col-md-6 form-group">
                                <input id="email" name="email" type="text" class="form-control" placeholder="Votre Email*" data-rule="email" data-msg="s\'il vous plait veuillez entrer un email valid">
                                <small id="validate_email" class="validate"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <textarea id="comment" name="comment" class="form-control" placeholder="Votre commentaire*" data-rule="required" data-msg="S\'il vous plait veuiller entrer quelques"></textarea>
                                <small id="validate_comment" class="validate"></small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary currentSend">Poster Commentaire</button>
                        <center><img src="../admin/img/loader.gif" class="loader" style="display:none;"></center>
                    </form>

                </div>

            </div><!-- End blog comments -->';

    endforeach;


    $data = array(
        'article_response' => $resultat,
        'postID' => $_POST['articles_click']
    );


    echo json_encode($data);
}


/* ==========================================================================
SYSTEME DE GESTION LA ZONE PAGINATION DU BLOG
   ========================================================================== */
if (isset($_POST['pagination']) && isset($_POST['nbre_Article'])) {
    $nombreDeMessagesParPage = intval($_POST['nbre_Article']);
    $pages = intval($_POST['pagination']);

    // On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
    $premierMessageAafficher = ($pages - 1) * $nombreDeMessagesParPage;


    $post = $connexion->compteur_start_end('SELECT posts.id AS id_posts, title, content, post_type, likes, dislike, favourited, posts.created_at,
                                                            user_id, category_id, images.id AS id_images, url_miniature, url,
                                                     u.first_name, u.last_name, u.linkedin, u.instagram, u.facebook, u.twitter,
                                                     u.email, u.avatar, u.profession 
                                                     FROM posts
                                                     INNER JOIN images
                                                     ON posts.id=images.post_id
                                                     INNER JOIN users u 
                                                     ON posts.user_id = u.id
                                                     ORDER BY posts.id DESC LIMIT :offset , :limit');
    $post->bindParam(':offset', $premierMessageAafficher, PDO::PARAM_INT);
    $post->bindParam(':limit', $nombreDeMessagesParPage, PDO::PARAM_INT);
    $post->execute();
    while ($post_item = $post->fetch()) {
        ?>
        <article class="entry" data-aos="fade-up">

            <div class="entry-img">
                <?php
                $myImg = str_replace('../../public/', '', $post_item['url']);
                ?>
                <img src="<?= $myImg; ?>" alt="<?= $post_item['title']; ?>" title="<?= $post_item['title']; ?>"
                     class="img-fluid">
            </div>

            <h2 class="entry-title">
                <a data="articles=<?= $post_item['id_posts']; ?>" href="#"
                   class="link_articles"><?= $post_item['title']; ?></a>
            </h2>

            <div class="entry-meta">
                <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                data="articles=<?= $post_item['id_posts']; ?>" href="#"
                                onclick="return false;"><?= $post_item['first_name'] . ' ' . $post_item['last_name']; ?></a>
                    </li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a
                                data="articles=<?= $post_item['id_posts']; ?>" href="#" onclick="return false;">
                            <time class="timeago"
                                  datetime="<?= date('c', strtotime($post_item['created_at'])); ?>"></time>
                        </a></li>
                    <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a
                                data="articles=<?= $post_item['id_posts']; ?>" href="#" onclick="return false;">
                            <?php
                            $result = $connexion->rowCount('SELECT comments.id AS id_comments, comments.content, comments.created_at, users.first_name, users.last_name FROM posts
                            INNER JOIN comments
                            ON posts.id=comments.post_id
                            INNER JOIN users
                            ON users.id=comments.user_id
                            WHERE posts.id=' . $post_item['id_posts']);
                            if (intval($result) == 0)
                                echo $result . ' Commentaire';
                            elseif (intval($result) == 1)
                                echo $result . ' Commentaire';
                            else
                                echo $result . ' Commentaires';
                            ?>
                        </a></li>

                </ul>
            </div>

            <div class="entry-content overflow-auto">
                <p>
                    <?= htmlspecialchars_decode($post_item['content']); ?>
                </p>
                <div class="read-more">
                    <a data="articles=<?= $post_item['id_posts']; ?>" tabindex="-1" class="link_articles" href="#"
                       title="Lire la suite">Lire la Suite</a>
                </div>
            </div>

        </article><!-- End blog entry -->
        <?php
    }//fin de while
}


/* ==========================================================================
SYSTEME DE CHARGEMENT DES COMMENTAIRES
   ========================================================================== */
if (isset($_POST['postID'])) {
    $resultat = '';

    $resultat .= '<h4 class="comments-count">';

    $result = $connexion->rowCount('SELECT comments.id AS id_comments, comments.content, comments.created_at, users.first_name, users.last_name FROM posts
                                               INNER JOIN comments
                                               ON posts.id=comments.post_id
                                               INNER JOIN users
                                               ON users.id=comments.user_id
                                               WHERE posts.id=' . $_POST['postID']);
    if (intval($result) == 0)
        $resultat .= $result . ' Commentaire';
    elseif (intval($result) == 1)
        $resultat .= $result . ' Commentaire';
    else
        $resultat .= $result . ' Commentaires';


    $resultat .= '</h4>';


    foreach ($connexion->query('  SELECT comments.id AS id_comments, comments.content, comments.created_at, users.first_name, users.last_name, avatar 
                                               FROM posts
                                               INNER JOIN comments
                                               ON posts.id=comments.post_id
                                               INNER JOIN users
                                               ON users.id=comments.user_id
                                               WHERE comments.post_id ="' . intval($_POST['postID']) . '" ORDER BY id_comments DESC') as $comment):

        $resultat .= '<div id="comment-' . $comment->id_comments . '" class="comment clearfix">';
        if ($comment->avatar == '')
            $resultat .= '<img src="assets/img/profil3.png" class="comment-img  float-left" alt="">';
        else
            $resultat .= '<img src="' . str_replace('../../public/', '', $comment->avatar) . '" class="comment-img  float-left" alt="">';
        $resultat .= '<h5><a href="">' . $comment->last_name . ' ' . $comment->first_name . '</a> <a data="' . $comment->id_comments . '" onclick="return false;" data-toggle="collapse" data-target="#commentaire-reponses' . $comment->id_comments . '" href="#" class="reply"><i class="icofont-reply"></i> Repondre</a></h5>';
        $datetimeFormat = 'Y-m-d H:i:s';
        $date = new \DateTime();
        $date->setTimestamp($comment->created_at);
        $date_comment = $date->format($datetimeFormat);
        $date_comment = date('c', strtotime($date_comment));


        $resultat .= '<time class="timeago" datetime="' . $date_comment . '">' . date('j F Y à H:i', strtotime($date_comment)) . '</time>

                <p>' . htmlspecialchars_decode(nl2br($comment->content)) . '</p>';


        $resultat .= '<div id="commentaire-reponses' . $comment->id_comments . '" class="reply-form collapse">
                    <h4>Répondre un commentaire</h4>
                    <div id="rapport_comment' . $comment->id_comments . '" class="alert alert-danger rapport_response_comment" style="display:none;"></div>
                    <form id="form_comment' . $comment->id_comments . '" action="forms/contact.php" role="form" class="php-email-form" onsubmit="return false;">
                        <div class="row">
                            <input type="hidden" name="post_id' . $comment->id_comments . '" value="' . $_POST['postID'] . '">
                            <div class="col-md-6 form-group">
                                <input data="' . $comment->id_comments . '" id="name' . $comment->id_comments . '" name="name' . $comment->id_comments . '" type="text" class="form-control" placeholder="Votre Nom*" data-rule="minlen:4" data-msg="s\'il vous veuillez entrer au moins 4 charactères">
                                <small id="validate_name' . $comment->id_comments . '" class="validate"></small>
                            </div>
                            <div class="col-md-6 form-group">
                                <input data="' . $comment->id_comments . '" id="email' . $comment->id_comments . '" name="email' . $comment->id_comments . '" type="email" class="form-control" placeholder="Votre Email*" data-rule="email" data-msg="s\'il vous plait veuillez entrer un email valid">
                                <small id="validate_email' . $comment->id_comments . '" class="validate"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <textarea data="' . $comment->id_comments . '" id="comment' . $comment->id_comments . '" name="comment' . $comment->id_comments . '" class="form-control" placeholder="Votre commentaire*" data-rule="required" data-msg="S\'il vous plait veuiller entrer quelques"></textarea>
                                <small id="validate_comment' . $comment->id_comments . '" class="validate"></small>
                            </div>
                        </div>
                        <button data="' . $comment->id_comments . '" type="submit" class="btn btn-primary currentSend' . $comment->id_comments . '">Poster Commentaire</button>
                        <center><img src="../admin/img/loader.gif" class="loader" style="display:none;"></center>
                    </form>

                </div>';

        foreach ($connexion->query('SELECT comments_reply.id AS id_comments_reply, comments_reply.content, comments_reply.created_at, users.first_name, users.last_name, avatar, comments_reply.comments_id 
                                               FROM comments
                                               INNER JOIN comments_reply
                                               ON comments.id=comments_reply.comments_id
                                               INNER JOIN users
                                               ON users.id=comments_reply.user_id
                                               WHERE comments_reply.comments_id  ="' . intval($comment->id_comments) . '" ORDER BY id_comments_reply DESC') as $reply):

            $resultat .= '<div id="comment-reply-' . $reply->id_comments_reply . '" class="comment comment-reply clearfix">';
            if ($comment->avatar == '')
                $resultat .= '<img src="assets/img/profil3.png" class="comment-img  float-left" alt="">';
            else
                $resultat .= '<img src="' . str_replace('../../public/', '', $comment->avatar) . '" class="comment-img  float-left" alt="">';
            $resultat .= '<h5><a href="">' . $reply->last_name . ' ' . $reply->first_name . '</a></h5>';
            $datetimeFormat = 'Y-m-d H:i:s';
            $date = new \DateTime();
            $date->setTimestamp($reply->created_at);
            $date_comment = $date->format($datetimeFormat);
            $date_comment = date('c', strtotime($date_comment));

            $resultat .= '<time class="timeago" datetime="' . $date_comment . '">' . date('j F Y à H:i', strtotime($date_comment)) . '</time>

                  <p>' . htmlspecialchars_decode(nl2br($reply->content)) . '</p>

                </div><!-- End comment reply #1-->';

        endforeach;


        $resultat .= '</div><!-- End comment #1 -->';
    endforeach;

    $resultat .= '<div class="reply-form">
                    <h4>Commenter</h4>
                    <div class="alert alert-danger rapport_comment" style="display:none;"></div>
                    <form id="form_comment" action="forms/contact.php" role="form" class="php-email-form" onsubmit="return false;">
                        <div class="row">
                            <input type="hidden" name="post_id" value="' . $_POST['postID'] . '">
                            <div class="col-md-6 form-group">
                                <input id="name" name="name" type="text" class="form-control" placeholder="Votre Nom*" data-rule="minlen:4" data-msg="s\'il vous veuillez entrer au moins 4 charactères">
                                <small id="validate_name" class="validate"></small>
                            </div>
                            <div class="col-md-6 form-group">
                                <input id="email" name="email" type="text" class="form-control" placeholder="Votre Email*" data-rule="email" data-msg="s\'il vous plait veuillez entrer un email valid">
                                <small id="validate_email" class="validate"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <textarea id="comment" name="comment" class="form-control" placeholder="Votre commentaire*" data-rule="required" data-msg="S\'il vous plait veuiller entrer quelques"></textarea>
                                <small id="validate_comment" class="validate"></small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary currentSend">Poster Commentaire</button>
                        <center><img src="../admin/img/loader.gif" class="loader" style="display:none;"></center>
                    </form>

                </div>';

    //  $count = $connexion->rowCount('SELECT * FROM body WHERE notification_vue="0"');
    $data = array(
        'commentaires' => $resultat
    );


    echo json_encode($data);

}


/* ==========================================================================
SYSTEME DE LA ZONE ARCHIVE DU BLOG
   ========================================================================== */
if (isset($_POST['m']) && isset($_POST['y'])) {
    extract($_REQUEST);
    $blog = App::getDB()->compteur_start_end('SELECT posts.id AS id_posts, posts.title, posts.content, post_type, likes, dislike, favourited, posts.created_at,
                                                            user_id, category_id, images.id AS id_images, url_miniature, url,
                                                      u.first_name, u.last_name, u.linkedin, u.instagram, u.facebook, u.twitter,
                                                     u.email, u.avatar, u.profession
                                                     FROM posts
                                                     INNER JOIN images
                                                     ON posts.id=images.post_id
                                                     INNER JOIN categories
                                                     ON posts.category_id=categories.id
                                                     INNER JOIN users u 
                                                     ON posts.user_id = u.id
                                                     WHERE YEAR(posts.created_at)=:annee AND MONTH(posts.created_at)=:mois
                                                     ORDER BY posts.id DESC');
    $blog->bindParam(':annee', $y, PDO::PARAM_INT);
    $blog->bindParam(':mois', $m, PDO::PARAM_INT);
    $blog->execute();
    while ($post_item = $blog->fetch()) {
        ?>
        <article class="entry" data-aos="fade-up">

            <div class="entry-img">
                <?php
                $myImg = str_replace('../../public/', '', $post_item['url']);
                ?>
                <img src="<?= $myImg; ?>" alt="<?= $post_item['title']; ?>" title="<?= $post_item['title']; ?>"
                     class="img-fluid">
            </div>

            <h2 class="entry-title">
                <a data="articles=<?= $post_item['id_posts']; ?>" href="#"
                   class="link_articles"><?= $post_item['title']; ?></a>
            </h2>

            <div class="entry-meta">
                <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                data="articles=<?= $post_item['id_posts']; ?>" href="#"
                                onclick="return false;"><?= $post_item['first_name'] . ' ' . $post_item['last_name']; ?></a>
                    </li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a
                                data="articles=<?= $post_item['id_posts']; ?>" href="#" onclick="return false;">
                            <time class="timeago"
                                  datetime="<?= date('c', strtotime($post_item['created_at'])); ?>"></time>
                        </a></li>
                    <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a
                                data="articles=<?= $post_item['id_posts']; ?>" href="#" onclick="return false;">
                            <?php
                            $result = App::getDB()->rowCount('SELECT comments.id AS id_comments, comments.content, comments.created_at, users.first_name, users.last_name FROM posts
                            INNER JOIN comments
                            ON posts.id=comments.post_id
                            INNER JOIN users
                            ON users.id=comments.user_id
                            WHERE posts.id=' . $post_item['id_posts']);
                            if (intval($result) == 0)
                                echo $result . ' Commentaire';
                            elseif (intval($result) == 1)
                                echo $result . ' Commentaire';
                            else
                                echo $result . ' Commentaires';
                            ?>
                        </a></li>
                </ul>
            </div>

            <div class="entry-content overflow-auto">
                <p>
                    <?= substr(htmlspecialchars_decode($post_item['content']), MIN_CHARACTER, MAX_CHARACTER) ?>
                </p>
                <div class="read-more">
                    <a data="articles=<?= $post_item['id_posts']; ?>" tabindex="-1" class="link_articles" href="#"
                       title="Lire la suite">Lire la Suite</a>
                </div>
            </div>

        </article><!-- End blog entry -->
        <?php
    }//fin de while
    // require '../../Pages/Blog_Aside.php';
}


/* ==========================================================================
SYSTEME DE LA ZONE CATEGORIE DU BLOG
   ========================================================================== */
if (isset($_POST['categories'])) {
    $blog = App::getDB()->compteur_start_end('  SELECT posts.id AS id_posts, posts.title, posts.content, post_type, likes, dislike, favourited, posts.created_at,
                                                            user_id, category_id, images.id AS id_images, url_miniature, url FROM posts
                                                         INNER JOIN categories
                                                         ON posts.category_id=categories.id
                                                         INNER JOIN images
                                                         ON posts.id=images.post_id
                                                         INNER JOIN users u 
                                                         ON posts.user_id = u.id
                                                         WHERE categories.id=:id_cat
                                                         ORDER BY posts.id DESC');
    $blog->bindParam(':id_cat', $_POST['categories'], PDO::PARAM_INT);
    $blog->execute();
    while ($post_item = $blog->fetch()) {
        ?>

        <article class="entry" data-aos="fade-up">

            <div class="entry-img">
                <?php
                $myImg = str_replace('../../public/', '', $post_item['url']);
                ?>
                <img src="<?= $myImg; ?>" alt="<?= $post_item['title']; ?>" title="<?= $post_item['title']; ?>"
                     class="img-fluid">
            </div>

            <h2 class="entry-title">
                <a data="articles=<?= $post_item['id_posts']; ?>" href="#"
                   class="link_articles"><?= $post_item['title']; ?></a>
            </h2>

            <div class="entry-meta">
                <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                data="articles=<?= $post_item['id_posts']; ?>" href="#" onclick="return false;">John
                            Doe</a></li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a
                                data="articles=<?= $post_item['id_posts']; ?>" href="#" onclick="return false;">

                            <time class="timeago"
                                  datetime="<?= date('c', strtotime($post_item['created_at'])); ?>"></time>
                        </a></li>
                    <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a
                                data="articles=<?= $post_item['id_posts']; ?>" href="#" onclick="return false;">
                            <?php
                            $result = App::getDB()->rowCount('SELECT comments.id AS id_comments, comments.content, comments.created_at, users.first_name, users.last_name FROM posts
                            INNER JOIN comments
                            ON posts.id=comments.post_id
                            INNER JOIN users
                            ON users.id=comments.user_id
                            WHERE posts.id=' . $post_item['id_posts']);
                            if (intval($result) == 0)
                                echo $result . ' Commentaire';
                            elseif (intval($result) == 1)
                                echo $result . ' Commentaire';
                            else
                                echo $result . ' Commentaires';
                            ?>
                        </a></li>
                </ul>
            </div>

            <div class="entry-content overflow-auto">
                <p>
                    <?= substr(htmlspecialchars_decode($post_item['content']), MIN_CHARACTER, MAX_CHARACTER) ?>
                </p>
                <div class="read-more">
                    <a data="articles=<?= $post_item['id_posts']; ?>" tabindex="-1" class="link_articles" href="#"
                       title="Lire la suite">Lire la Suite</a>
                </div>
            </div>

        </article><!-- End blog entry -->

        <?php
    }//fin de while
}


/* ==========================================================================
SYSTEME DE GESTION DE RECHERCHES INSTANTANEES
========================================================================== */

if (isset($_GET['search_contenu'])) {
    $result = '';
    $_GET['search_contenu'] = htmlentities((stripslashes(htmlspecialchars($_GET['search_contenu']))), ENT_QUOTES);
    $_GET['search_contenu'] = strip_tags(trim($_GET['search_contenu'])); //supprimes balises html et supprime les espaces
    $connexion = App::getDB();
    $nbre = $connexion->rowCount('SELECT posts.id AS id_posts, posts.title, posts.content, post_type, likes, dislike, favourited, posts.created_at,
                                                            user_id, category_id,
                                                         u.first_name, u.last_name, u.linkedin, u.instagram, u.facebook, u.twitter,
                                                         u.email, u.avatar, u.profession 
                                                         FROM posts
                                                         INNER JOIN categories
                                                         ON posts.category_id=categories.id
                                                         INNER JOIN users u 
                                                         ON posts.user_id = u.id
                                                         WHERE posts.content LIKE "%' . $_GET['search_contenu'] . '%" OR posts.title LIKE "%' . $_GET['search_contenu'] . '%" OR categories.title LIKE "%' . $_GET['search_contenu'] . '%" ');

    if ($nbre <= 0) {
        $result .= 'Aucun';
    } else {
        foreach (App::getDB()->query('SELECT posts.id AS id_posts, posts.title, posts.content, post_type, likes, dislike, favourited, posts.created_at,
                                                            user_id, category_id, images.id AS id_images, url_miniature, url, categories.title,
                                                            u.first_name, u.last_name, u.linkedin, u.instagram, u.facebook, u.twitter,
                                                            u.email, u.avatar, u.profession 
                                                    FROM posts
                                                    INNER JOIN images
                                                    ON posts.id=images.post_id
                                                    INNER JOIN categories
                                                    ON posts.category_id=categories.id
                                                    INNER JOIN users u 
                                                    ON posts.user_id = u.id
                                                    WHERE posts.content LIKE "%' . $_GET['search_contenu'] . '%" 
                                                    OR posts.title LIKE "%' . $_GET['search_contenu'] . '%"
                                                    OR categories.title LIKE "%' . $_GET['search_contenu'] . '%"
                                                    ORDER BY posts.id DESC ') as $post_item):

            $result .= '<article class="entry" data-aos="fade-up">
                <div class="entry-img">';
            $myImg = str_replace('../../public/', '', $post_item->url);
            $result .= '<img src="' . $myImg . '" alt="' . $post_item->title . '" title="' . $post_item->title . '" class="img-fluid">
             </div>
             <h2 class="entry-title">
             <a data="articles=' . $post_item->id_posts . '" href="#" class="link_articles">' . $post_item->title . '</a>
             </h2>
              <div class="entry-meta">
                    <ul>
                        <li class="d-flex align-items-center"><i class="icofont-user"></i> <a data="articles=' . $post_item->id_posts . '" href="#" onclick="return false;">' . $post_item->first_name . ' ' . $post_item->last_name . '</a></li>
                        <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a data="articles=' . $post_item->id_posts . '" href="#" onclick="return false;">
                        <time class="timeago" datetime="' . date('c', strtotime($post_item->created_at)) . '"></time></a></li>
                        <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a data="articles=' . $post_item->id_posts . '" href="#" onclick="return false;">';

            $resultat = App::getDB()->rowCount('SELECT comments.id AS id_comments, comments.content, comments.created_at, users.first_name, users.last_name FROM posts
                            INNER JOIN comments
                            ON posts.id=comments.post_id
                            INNER JOIN users
                            ON users.id=comments.user_id
                            WHERE posts.id=' . $post_item->id_posts);
            if (intval($resultat) == 0)
                $result .= $resultat . ' Commentaire';
            elseif (intval($resultat) == 1)
                $result .= $resultat . ' Commentaire';
            else
                $result .= $resultat . ' Commentaires';

            $result .= '</a></li>
                    </ul>
                </div>
                 <div class="entry-content overflow-auto">
                    <p>' . substr(htmlspecialchars_decode($post_item->content), MIN_CHARACTER, MAX_CHARACTER) . '
                      </p>
                    <div class="read-more">
                    <a data="articles=' . $post_item->id_posts . '" tabindex="-1" class="link_articles" href="#" title="Lire la suite">Lire la Suite</a>
                         </div>
                </div>
            </article><!-- End blog entry -->';

        endforeach;


    }
    $data = array(
        'resultat' => $result,
        'compteur' => $nbre
    );


    echo json_encode($data);

}


/* ==========================================================================
SYSTEME DE VERIFICATION DE LA SECTION NEWSLETTER
   ========================================================================== */

if (isset($_GET['newsletter'])) {

    if (isset($_POST['newsletter'])) {

        extract($_POST);

        if (strlen($_POST['newsletter']) < 4 || strlen($_POST['newsletter']) > 20) {
            echo 'L\'adresse Email est compris entre 3 et 16 caractères<br>';
            exit;
        }

        if (!filter_var($_POST['newsletter'], FILTER_VALIDATE_EMAIL)) { //Validation d'une adresse de messagerie.
            echo 'Votre Adresse E-mail n\'est pas valide<br>';
            exit();
        }

        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id FROM newsletters WHERE email_newsletter ="' . $_POST['newsletter'] . '"');
        if ($nbre > 0) {
            echo 'Cet Email est déjà utilisé<br>';
            exit;
        } else {
            echo 'success';
        }
    }
}


if(isset($_GET['singIn']))
{
    if(isset($_POST['emailSingIn'])){

        nettoieProtect();
        extract($_POST);

        if(strlen($_POST['emailSingIn']) < 4 || strlen($_POST['emailSingIn']) > 20 ){
            echo '<br>L\'adresse Email est compris entre 3 et 16 caractères';
            exit;
        }

        if(is_numeric($_POST['emailSingIn'][0])){
            echo '<br>L\'adresse email doit commencer par une lettre';
            exit;
        }

        if(!filter_var($_POST['emailSingIn'], FILTER_VALIDATE_EMAIL)) { //Validation d'une adresse de messagerie.
            echo '<br>Votre Adresse E-mail n\'est pas valide';
            exit();
        }


        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['emailSingIn'].'"');
        if($nbre <= 0){
            echo '<br>Votre Email n\'existe pas';
            exit;
        }
        else{
            echo 'success';
        }
    }


    if(isset($_POST['passwordSingIn'])){

        nettoieProtect();
        extract($_POST);
        $passwordSingIn = preg_replace('#[^a-z0-9_-]#i', '', $passwordSingIn); //filter everything
        // Connexion à la base de données

        $connexion = App::getDB();
        if(strlen($passwordSingIn) < 4 || strlen($passwordSingIn) > 30 ){
            echo '<br>Le Mot de Passe est compris entre 4 et 30 caractères';
            exit;
        }

        $passwordSingIn = sha1($passwordSingIn);
        $nbre = $connexion->rowCount('SELECT id FROM users WHERE password="'.$passwordSingIn.'"');
        if($nbre <= 0){
            echo '<br>Ce Mot de Passe n\'existe pas';
            exit;
        }
        else{
            echo 'success';
        }
    }

}





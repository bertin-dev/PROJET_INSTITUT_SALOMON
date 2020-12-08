<div class="sidebar" data-aos="fade-left">

    <h3 class="sidebar-title">Recherche</h3>
    <div class="sidebar-item search-form">
        <form id="search_sujet" action="#" method="get" class="" role="search" onsubmit="return false;">
            <input id="search_contenu" type="text" name="search_contenu" value="<?php if(isset($_GET['search_contenu'])) echo $_GET['search_contenu'];?>">
            <button id="enreg_search" type="submit"><i class="icofont-search"></i></button>
        </form>
        <span id="output_search"></span>
    </div><!-- End sidebar search formn-->

    <h3 class="sidebar-title">Categories</h3>
    <div class="sidebar-item categories">
        <ul>
            <?php
            foreach (App::getDB()->query('SELECT * FROM categories') AS $category):
            ?>
                <li><a class="categorie" href="#" data="<?=$category->id;?>"><?=$category->title;?>
                 <?php
                 $result = App::getDB()->rowCount('SELECT * FROM posts 
                                                            INNER JOIN categories
                                                            ON categories.id=posts.category_id
                                                            WHERE categories.id='.$category->id);
                 echo '<span>('.$result.')</span></a></li>';
                 ?>
              <?php
            endforeach;
            ?>
        </ul>

    </div><!-- End sidebar categories-->

    <h3 class="sidebar-title">Derniers Posts</h3>
    <div class="sidebar-item recent-posts">
        <?php
        foreach (App::getDB()->query('SELECT posts.id AS id_posts, title, content, post_type, likes, dislike, favourited, posts.created_at,
                                                            user_id, category_id, images.id AS id_images, url_miniature, url FROM posts
                                                     INNER JOIN images
                                                     ON posts.id=images.post_id
                                                     ORDER BY posts.id DESC LIMIT 3') AS $recent_post):

        echo '<div class="post-item clearfix">
            <img src="'.str_replace('../../public/', '', $recent_post->url).'" alt="'.$recent_post->title.'" title="'.$recent_post->title.'">
            <h4><a onclick="return false;" data="articles='.$recent_post->id_posts.'" href="#" class="link_articles">'.strtolower($recent_post->title).'</a></h4>';
            echo '<time class="timeago" datetime="'.date('c', strtotime($recent_post->created_at)).'"></time>
        </div>';

        endforeach;
        ?>

    </div><!-- End sidebar recent posts-->

    <h3 class="sidebar-title">Tags</h3>
    <div class="sidebar-item tags">
        <ul>
            <li><a href="#">App</a></li>
            <li><a href="#">IT</a></li>
            <li><a href="#">Business</a></li>
            <li><a href="#">Business</a></li>
            <li><a href="#">Mac</a></li>
            <li><a href="#">Design</a></li>
            <li><a href="#">Office</a></li>
            <li><a href="#">Creative</a></li>
            <li><a href="#">Studio</a></li>
            <li><a href="#">Smart</a></li>
            <li><a href="#">Tips</a></li>
            <li><a href="#">Marketing</a></li>
        </ul>

    </div><!-- End sidebar tags-->



    <h3 class="sidebar-title">Archives</h3>
    <div class="sidebar-item categories">
        <ul>
            <?php

            foreach (App::getDB()->query('SELECT DATE_FORMAT(created_at, "%M %Y") AS date_pub_article, 
                                                                 DATE_FORMAT(created_at, "%m") AS m, 
                                                                 DATE_FORMAT(created_at, "%Y") AS y, 
                                                                 COUNT(id) AS nbrID, created_at 
                                                          FROM posts 
                                                          GROUP BY DATE_FORMAT(created_at, "%Y%M")') AS $total):


                echo '<li> 
                    <a data="mois='.$total->m.'&annee='.$total->y.'" href="#" class="archive">' . $total->date_pub_article . '<span class="counter">' . ' ('. $total->nbrID.')' . '</span>
                    </a>
                         </li>';
            endforeach;
            ?>

        </ul>

    </div><!-- End sidebar recent posts-->

</div><!-- End sidebar -->
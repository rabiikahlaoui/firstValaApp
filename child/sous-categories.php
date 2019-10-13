<?php

/* Template Name: sous categories
 * Template part for displaying post archives and search results
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
   <style>
    #portfoliolist .card {
        /*display: none;
        float: left;*/
        overflow: hidden;
    }

    .portfolio-wrapper {
        position: relative !important;
    }

</style>

<div id="filters" class="sous-categories">
    <button class="filter active" data-filter=".card">All</button><?php 
        $subcats = get_categories('child_of=' . $_GET['cat']);
        $ids = array();
        foreach($subcats as $subcat) {
            /*echo '<button class="filter" data-filter=".cat' .
                $subcat->cat_ID . '">' . $subcat->cat_name .
                '</button>';*/
            echo '<button onclick="showOnly(' .
                $subcat->cat_ID . ')">' . $subcat->cat_name .
                '</button>';
            $ids[] = $subcat->cat_ID;
        }
    ?>
</div>


<div id="portfoliolist" class="card-columns">
    <?php 
        // $args = array('posts_per_page' => 2, 'category' =>$cat, 'paged' => $step);
        $args = array('posts_per_page' => 2, 'category' => $ids);
        $subcat_posts = get_posts($args);
        foreach($subcat_posts as $subcat_post) {
            $postID = $subcat_post->ID;
            echo '<div class="card cat' . $subcat->cat_ID . '">';
            echo '<h1>';
            echo get_the_title($postID);
            echo '</h1></div>';
        }
        
    ?>
</div>
<div style="clear:both">
    <button onclick="loadMore(this, <?= $_GET['cat'] ?>)" data-page="2">Load more from <?= $_GET['cat'] ?></button>
</div>

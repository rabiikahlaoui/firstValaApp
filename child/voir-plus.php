<?php

/* Template Name: voire plus
 * Template part for displaying post archives and search results
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
   <?php 
    $cat= $_GET['cat'];
    $page= $_GET['pg'];
    $subcats = get_categories('child_of=' . $cat);
    $ids = array();
    foreach($subcats as $subcat) {
        $ids[] = $subcat->cat_ID;
    }
    $args = array('posts_per_page' => 2, 'category' => $ids, 'paged' => $page);
    $subcat_posts = get_posts($args);
    foreach($subcat_posts as $subcat_post) {
        $postID = $subcat_post->ID;
        echo '<div class="card cat' . $subcat->cat_ID . '">';
        echo '<h1>';
        echo get_the_title($postID);
        echo '</h1></div>';
    }
    
?>
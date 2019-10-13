<?php

/* Template Name: Home page initiale
 * Template part for displaying post archives and search results
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
if (!is_user_logged_in()) 
{ 
    //header('Location: http://localhost/evaste-test2/wp-admin/');
    header('Location: http://localhost/wiki/wp-admin/');
        echo '<a href="/wp-login.php" title="Members Area Login" rel="home"></a>';
	die;
}

get_header(); 
// $items = get_field("u_items");
?>

<!--
    <?php // foreach($items as $item) {
?>
    <div><?php // echo  $item["title"]; 
?></div>
    <?php // } 
?> 
-->
<?php
get_header();
global $header_var;

        $subcats = get_categories('child_of=' . $header_var);
        $ids = array();
        foreach($subcats as $subcat) {
            $ids[] = $subcat->cat_ID;
        }

?>

<nav class="jumbotron pb-md-0 pb-3 pt-3">
    <div class="row">
        <div class="col-12 col-md-8">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a><?= get_cat_name($header_var) ?></a></li>
                <li class="breadcrumb-item"><a id="sous-categorie">Tous</a></li>
            </ol>
        </div>

        <div class="col-12 col-md-4">
            <div id="social-menu" class="text-center">
                <div id="search">
                    <i class="fa fa-search"></i><input type="text" id="quicksearch" class="form-control" placeholder="Rechercher">
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="content min-height">
    <div class="container-fluid">


        <div class="actualite isotope" id="content-section">

            <?php 
        $args = array('posts_per_page' => -1, 'category' => $ids);
        $subcat_posts = get_posts($args);
        foreach($subcat_posts as $subcat_post) {
            $postID = $subcat_post->ID;
            $category_detail=get_the_category($postID);
            $categories = " ";
            foreach($category_detail as $cd){
                $categories .= 'cat'.$cd->cat_ID . ' ';
            }
            echo '
            <div class="col-md-4 element-item mb-3 mt-5 vikser '.$categories.'">
                <div class="actualite-container">
                    <a href="#">
                        <h5 class="title">'.get_the_title($postID).'</h5>
                    </a>

                    <div class="container">'.$subcat_post->post_content.'</div>

                </div>
            </div>
            ';
        }
        
    ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>

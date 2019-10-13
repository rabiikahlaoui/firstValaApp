<?php

define('TEMPLATEPATH', get_template_directory());
$home = "http://localhost/wiki/wp-content/themes/evaste-child3/";

function load_stylesheets()

{
    global $home;
    
    // wp_register_style( 'bootstrap', $home . 'css/bootstrap.css', array(), false, 'all');
    wp_register_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');

}
add_action('wp_enqueue_scripts', 'load_stylesheets');

function includejquery()
{
	wp_deregister_script('jquery');
}
add_action('wp_enqueue_scripts','includejquery');

function loadjs()
{
    global $home;
    
    // wp_register_script('jquery', $home . 'js/jquery-2.2.2.min.js','',1,true);
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.slim.min.js','',1,true);
    wp_enqueue_script('jquery');
    
    wp_register_script('popper_js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js','',1,true);
    wp_enqueue_script('popper_js');
    
    //wp_register_script('bootstrap_js', $home . 'js/bootstrap.min.js','',1,true);
    wp_register_script('bootstrap_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js','',1,true);
    wp_enqueue_script('bootstrap_js');
    
    wp_register_script('isotop', $home . 'js/isotope.min.js','',1,true);
    wp_enqueue_script('isotop');
    
    wp_register_script('index', $home . 'js/index.js','',1,true);
    wp_enqueue_script('index');
}
add_action('wp_enqueue_scripts','loadjs');

function custom_rewrite_basic() {
  add_rewrite_rule('^([0-9]+)/?', '?test=$matches[1]', 'top');
}
add_action('init', 'custom_rewrite_basic');
flush_rewrite_rules();
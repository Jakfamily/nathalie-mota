<?php
// Ajout des styles personnalisés
function enqueue_custom_styles()
{
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/scss/style.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Ajout du support pour la balise de titre
function theme_slug_setup()
{
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'theme_slug_setup');

// Enregistrement des menus
function register_menus()
{
    register_nav_menus(
        array(
            'header-menu' => 'menu header',
            'footer-menu' => 'menu footer'
        )
    );
}
add_action('init', 'register_menus');

// Ajout du support pour les miniatures (post-thumbnails)
function theme_support_post_thumbnails()
{
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'theme_support_post_thumbnails');


// Ajout des scripts personnalisés
function enqueue_custom_scripts()
{
    // Enqueue jQuery from CDN
    wp_enqueue_script('jquery-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);

    // Enqueue modale-contact.js
    wp_enqueue_script('modale-contact-script', get_template_directory_uri() . '/assets/js/modale-contact.js', array('jquery'), '1.0.0', true);

    // Enqueue burger-menu.js
    wp_enqueue_script('menu-burger-script', get_template_directory_uri() . '/assets/js/menu-burger.js', array('jquery'), '1.0.0', true);

    // Enqueue miniatures.js
    wp_enqueue_script('miniatures-script', get_template_directory_uri() . '/assets/js/miniatures.js', array('jquery'), '1.0.0', true);

    //Enqueue load-more.js
    wp_enqueue_script('load-more-script', get_template_directory_uri() . '/assets/js/load-more.js', array('jquery'), '1.0.0', true);

    // Enqueue lightbox.js
    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

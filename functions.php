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

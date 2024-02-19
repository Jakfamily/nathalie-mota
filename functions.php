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

    // Enqueue lightbox.js
    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function enqueue_load_more_photos_script() {
    wp_enqueue_script('load-more-photos', get_template_directory_uri() . '/assets/js/load-more-photos.js', array('jquery'), null, true);

    // Passer des paramètres AJAX à votre script
    wp_localize_script('load-more-photos', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_load_more_photos_script');


function load_more_photos() {
    $page = $_POST['page'];
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 12,
        'orderby'        => 'date',
        'order'          => 'ASC',
        'paged'          => $page,
    );

    $photo_block = new WP_Query($args);

    if ($photo_block->have_posts()) :
        while ($photo_block->have_posts()) :
            $photo_block->the_post();
            get_template_part('template-parts/bloc-photo', get_post_format());
        endwhile;
        wp_reset_postdata();
    else :
        echo 'Aucune photo trouvée.';
    endif;

    die(); // N'oubliez pas cette ligne pour terminer le traitement AJAX
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos'); // Pour les utilisateurs non connectés

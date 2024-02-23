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

    // Enqueue filtre.js
    wp_enqueue_script('filtre-script', get_template_directory_uri() . '/assets/js/filtre.js', array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Ajout du script load-more-photos.js et filtre.js avec wp_localize_script pour passer des paramètres AJAX
function enqueue_load_more_photos_script() {
    wp_enqueue_script('load-more-photos', get_template_directory_uri() . '/assets/js/load-more-photos.js', array('jquery'), null, true);

    wp_enqueue_script('filtre', get_template_directory_uri() . '/assets/js/filtre.js', array('jquery'), null, true);

    // Utilisez wp_localize_script pour passer des paramètres à votre script
    wp_localize_script('load-more-photos', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));

    wp_localize_script('filtre', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_load_more_photos_script');

// Fonction pour charger plus de photos via AJAX
function load_more_photos() {
    $page = $_POST['page'];
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => -1,
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

    die();
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos'); // Pour les utilisateurs non connectés

// Fonction pour filtrer les photos via AJAX
function filter_photos() {
    // Vérifiez si l'action est définie
    if (isset($_POST['action']) && $_POST['action'] == 'filter_photos') {
        // Récupérez les filtres et nettoyez-les
        $filter = array_map('sanitize_text_field', $_POST['filter']);

        // Construisez votre requête WP_Query avec les filtres
        $args = array(
            'post_type'      => 'photo',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'ASC',
            'tax_query'      => array(
                'relation' => 'AND',
            ),
        );

        // Ajoutez les taxonomies à la requête si elles sont spécifiées
        $taxonomy_filters = array('categorie', 'format', 'annees');

        foreach ($taxonomy_filters as $taxonomy_filter) {
            if (!empty($filter[$taxonomy_filter])) {
                $args['tax_query'][] = array(
                    'taxonomy' => $taxonomy_filter,
                    'field'    => 'slug',
                    'terms'    => $filter[$taxonomy_filter],
                );
            }
        }

        // Si l'année est spécifiée dans le filtre
        if (!empty($filter['years'])) {
            $args['order'] = ($filter['years'] == 'date_desc') ? 'DESC' : 'ASC';
        }

        // Effectuez la requête WP_Query
        $query = new WP_Query($args);

        // Vérifiez si la requête a réussi
        if ($query->have_posts()) {
            // Boucle à travers les résultats de la requête
            while ($query->have_posts()) :
                $query->the_post();
                // Récupérez et affichez les informations de chaque photo
                $photoId      = get_field('photo');
                $reference    = get_field('reference');
                $refUppercase = strtoupper($reference);
                // Affiche le bloc de photo
                get_template_part('template-parts/bloc-photo');
            endwhile;

            // Réinitialisez les données de post après la boucle de requête
            wp_reset_postdata();
        } else {
            // Aucune photo ne correspond aux critères de filtrage
            echo '<p class="critereFiltrage">Aucune photo ne correspond aux critères de filtrage</p>';
        }
    }

    // Assurez-vous que votre code renvoie la sortie souhaitée pour le traitement AJAX
    die();
}

// Hook pour les utilisateurs connectés
add_action('wp_ajax_filter_photos', 'filter_photos');
// Hook pour les utilisateurs non connectés
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');

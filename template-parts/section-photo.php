<?php
// Récupération de 12 photos aléatoires pour le bloc initial
$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 12,
    'orderby' => 'date',
    'order' => 'ASC',
);
$photo_block = new WP_Query($args);


if ($photo_block->have_posts()) :

    set_query_var('photo_block_args', array('context' => 'front-page'));
    while ($photo_block->have_posts()) :
        $photo_block->the_post();
        get_template_part('template-parts/bloc-photo', get_post_format());
?>

<?php
    endwhile;
    wp_reset_postdata();
else :
    echo 'Aucune photo trouvée.';
endif;
?>

<div id="blockPlusdImage">
    <button id="plusDImage" data-page="1" data-url="">Charger plus</button>
</div>

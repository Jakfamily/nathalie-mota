<?php get_header(); ?>

<section>
<?php get_template_part('template-parts/banner'); ?>
</section>

<section class="filtre">
<?php get_template_part('template-parts/filtre'); ?>
</section>

<section id="containerPhoto" class="blocCatalogue">
  <?php get_template_part('template-parts/section-photo'); ?>
</section>

<!-- Bloc pour le chargement de plus de photos -->
<div id="load-moreContainer">
    <button id="btnLoad-more" data-page="1" data-url="">Charger plus</button>
</div>

<?php get_footer(); ?>

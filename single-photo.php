<?php include_once 'variables.php';?>


<!-- Section d'affichage de la photo et des informations associées -->
<section class="cataloguePhotos">
  <div class="galleryPhotos">
    <div class="detailPhoto">
      <div class="containerPhoto">
        <!-- Affichage de l'image de la photo -->
        <img src="<?php echo esc_url($photoId); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
      </div>

      <div class="photo-info">
        <!-- Affichage du titre de la photo -->
        <h2><?php echo get_the_title(); ?></h2>
        <!-- Affichage des détails de la photo -->
        <div class="taxo-details">
          <p>RÉFÉRENCES: <?php echo esc_html($refUppercase); ?></p>
          <p>CATÉGORIE: <?php echo esc_html($categories ? $categories[0]->name : 'Non défini'); ?></p>
          <p>FORMAT: <?php echo esc_html($FORMATS); ?></p>
          <p>TYPE: <?php echo esc_html($type); ?></p>
          <p>ANNÉE: <?php echo esc_html($annee); ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Section de contact et navigation entre les photos -->
  <div class="contenairContact">
    <div class="contact">
      <p class="interesser">Cette photo vous intéresse ?</p>
      <!-- Bouton de contact avec la référence comme attribut de données -->
      <button id="boutonContact" data-reference="<?php echo esc_attr($reference); ?>">Contact</button>
    </div>

    <div class="naviguationPhotos">
      <!-- Conteneur pour la miniature de la photo -->
      <div class="miniPicture" id="miniPicture">
        <!-- La miniature sera chargée  ici par JavaScript -->
      </div>

      <div class="naviguationArrow">
        <!-- Flèches de navigation vers les photos précédentes et suivantes -->
        <?php if (!empty($previousPost)) : ?>
          <img class="arrow arrow-left" src="<?php echo get_theme_file_uri() . '/assets/images/left.png'; ?>" alt="Photo précédente" data-thumbnail-url="<?php echo esc_url($previousThumbnailURL); ?>" data-target-url="<?php echo esc_url(get_permalink($previousPost->ID)); ?>">
        <?php endif; ?>

        <?php if (!empty($nextPost)) : ?>
          <img class="arrow arrow-right" src="<?php echo get_theme_file_uri() . '/assets/images/right.png'; ?>" alt="Photo suivante" data-thumbnail-url="<?php echo esc_url($nextThumbnailURL); ?>" data-target-url="<?php echo esc_url(get_permalink($nextPost->ID)); ?>">
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

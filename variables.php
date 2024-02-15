<?php
// Récupération des champs ACF personnalisés pour l'article actuel
$photoId = get_field('photo');
$reference = get_field('reference');
$refUppercase = strtoupper($reference); // Conversion de la référence en majuscules
$type = get_field('type');

// Récupération des termes de la taxonomie 'annee' associés à l'article
$annees_terms = get_the_terms(get_the_ID(), 'annee');
// Vérification de l'existence des termes et non-vide
if ($annees_terms && !is_wp_error($annees_terms)) {
  // Prendre le premier terme, car un article peut avoir plusieurs termes
  $annee = $annees_terms[0]->name;
} else {
  // Définition d'une valeur par défaut si aucun terme n'est trouvé
  $annee = 'Non défini';
}

// Récupération des termes de la taxonomie 'categorie' et 'format'
$categories = get_the_terms(get_the_ID(), 'categorie');
$formats = get_the_terms(get_the_ID(), 'format');
$FORMATS = $formats ? ucwords($formats[0]->name) : ''; // Formatage du nom du format

// Définition des URLs des vignettes pour le post précédent et suivant
$nextPost = get_next_post();
$previousPost = get_previous_post();
$previousThumbnailURL = $previousPost ? get_the_post_thumbnail_url($previousPost->ID, 'thumbnail') : '';
$nextThumbnailURL = $nextPost ? get_the_post_thumbnail_url($nextPost->ID, 'thumbnail') : '';
?>

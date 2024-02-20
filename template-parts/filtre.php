<?php
// Affichage taxonomies
$taxonomy = [
    'categorie' => 'CATÉGORIES',
    'format' => 'FORMATS',
    'annees' => 'TRIER PAR',
];

echo "<div id='filtrePhoto'>";
echo "<div class='left-section'>";

foreach ($taxonomy as $taxonomy_slug => $label) {
    if ($taxonomy_slug !== 'annee') { // Exclure 'annees' de la section gauche
        $terms = get_terms($taxonomy_slug);
        if ($terms && !is_wp_error($terms)) {
            // Ajoutez une classe CSS spécifique pour chaque select
            $select_class = 'custom-select ' . $taxonomy_slug . '-select';

            echo "<div class='taxonomy-container'>";
            echo "<select id='$taxonomy_slug' class='$select_class'>";

            echo "<option value=''>$label</option>";
            foreach ($terms as $term) {
                echo "<option value='$term->slug'>$term->name</option>";
            }
            echo "</select>";
            echo "</div>";
        }
    }
}

echo "</div>"; // Fin de la section gauche
echo "<div class='right-section'>";

// Affichage pour 'annees' dans la section droite
$terms_annees = get_terms('annee');
if ($terms_annees && !is_wp_error($terms_annees)) {
    $select_class_annees = 'custom-select annees-select';

    echo "<div class='taxonomy-container'>";
    echo "<select id='annees' class='$select_class_annees'>";

    echo "<option value=''>$taxonomy[annees]</option>";
    foreach ($terms_annees as $term_annees) {
        echo "<option value='$term_annees->slug'>$term_annees->name</option>";
    }
    echo "</select>";
    echo "</div>";
}

echo "</div>"; // Fin de la section droite
echo "</div>"; // Fin du conteneur #filtrePhoto
?>

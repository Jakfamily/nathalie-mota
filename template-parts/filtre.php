<?php
// Définition des taxonomies à afficher
$taxonomy = [
    'categorie' => 'CATÉGORIES',
    'format' => 'FORMATS',
    'annees' => 'TRIER PAR',
];

// Début du conteneur pour les filtres photo
echo "<div id='filtrePhoto'>";

// Début de la section gauche
echo "<div class='left-section'>";

// Boucle pour chaque taxonomie (excepté 'annees') dans la section gauche
foreach ($taxonomy as $taxonomy_slug => $label) {
    if ($taxonomy_slug !== 'annees') { // Exclure 'annees' de la section gauche
        $terms = get_terms($taxonomy_slug);
        if ($terms && !is_wp_error($terms)) {
            // Ajouter une classe CSS spécifique pour chaque select
            $select_class = 'custom-select ' . $taxonomy_slug . '-select';

            // Afficher le conteneur pour chaque paire label/select
            echo "<div class='taxonomy-container'>";
            // Afficher le select avec son ID et sa classe
            echo "<select id='$taxonomy_slug' class='$select_class'>";
            // Ajouter une option par défaut
            echo "<option value=''>$label</option>";
            // Ajouter les options pour chaque terme de la taxonomie
            foreach ($terms as $term) {
                echo "<option value='$term->slug'>$term->name</option>";
            }
            // Fin du select et du conteneur
            echo "</select>";
            echo "</div>";
        }
    }
}

// Fin de la section gauche
echo "</div>";

// Début de la section droite
echo "<div class='right-section'>";

// Affichage pour 'annees' dans la section droite
$terms_annees = get_terms('annees');
if ($terms_annees && !is_wp_error($terms_annees)) {
    // Ajouter une classe CSS spécifique pour le select 'annees'
    $select_class_annees = 'custom-select annees-select';

    // Afficher le conteneur pour le select 'annees'
    echo "<div class='taxonomy-container'>";
    // Afficher le select 'annees' avec son ID et sa classe
    echo "<select id='annees' class='$select_class_annees'>";
    // Ajouter une option par défaut
    echo "<option value=''>$taxonomy[annees]</option>";
    // Ajouter les options pour chaque terme de la taxonomie 'annees'
    foreach ($terms_annees as $term_annees) {
        echo "<option value='$term_annees->slug'>$term_annees->name</option>";
    }
    // Fin du select 'annees' et du conteneur
    echo "</select>";
    echo "</div>";
}

// Fin de la section droite
echo "</div>";

// Fin du conteneur global pour les filtres photo
echo "</div>";
?>

jQuery(document).ready(function ($) {
  $("#categorie, #format, #annees").on("change", function () {
    // Capturer les valeurs des filtres
    var category = $("#categorie").val();
    var format = $("#format").val();
    var years = $("#annees").val();

    // Vérifier si les valeurs sont les valeurs par défaut
    var isDefaultValues = category === "" && format === "" && years === "";

    $.ajax({
      url: ajax_params.ajax_url,
      type: "post",
      data: {
        action: "filter_photos",
        filter: {
          category: category,
          format: format,
          years: years,
        },
      },
      success: function (response) {
        // Mettez à jour la section des photos avec les résultats filtrés
        $("#containerPhoto").html(response);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log(ajaxOptions);
      },
      complete: function () {
        // Si les valeurs sont les valeurs par défaut, relancer le conteneur photo
        if (isDefaultValues) {
          // Mettez à jour la section des photos avec le contenu par défaut
          $("#containerPhoto").load(window.location.href + " #containerPhoto");
        }
      },
    });
  });
});

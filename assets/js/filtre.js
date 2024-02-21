console.log("les Filtres : son js est chargé");

(function ($) {
  const ajaxurl = ajax_params.ajaxurl;
  const defaultFilterValues = {
    categorie: $("#categorie").val(),
    format: $("#format").val(),
    annees: $("#annee").val(),
  };

  function fetchFilteredPhotos() {
    const filter = {
      categorie: $("#categorie").val(),
      format: $("#format").val(),
      annees: $("#annee").val(),
    };

    $.ajax({
      url: ajaxurl,
      data: {
        action: "filter_photos",
        filter: filter,
      },
      type: "POST",
      beforeSend: function () {
        $("#containerPhoto").html('<div class="loading">Chargement...</div>');
      },
      success: function (data) {
        $("#containerPhoto").html(data);
        attachEventsToImages();
        setTimeout(function () {
          document.getElementById("containerPhoto").scrollIntoView();
        }, 0);
      },
    });
  }

  // Réinitialiser les valeurs par défaut au chargement de la page
  function resetFilterValues() {
    $("#categorie").val(defaultFilterValues.categorie);
    $("#format").val(defaultFilterValues.format);
    $("#annee").val(defaultFilterValues.annees);
  }

  // Attacher l'événement au chargement de la page
  $(function () {
    resetFilterValues();
    fetchFilteredPhotos();
  });

  // Attacher l'événement de changement de filtre
  $("#filtrePhoto select").on("change", function (event) {
    event.preventDefault();
    fetchFilteredPhotos();
  });
})(jQuery);

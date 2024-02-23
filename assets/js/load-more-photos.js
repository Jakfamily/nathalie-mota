jQuery(function ($) {
  // Fonction pour gérer le chargement du contenu additionnel
  function loadMoreContent() {
    const page = $("#btnLoad-more").data("page");
    const newPage = page + 1;
    const ajaxurl = ajax_params.ajax_url;

    $.ajax({
      url: ajaxurl,
      type: "post",
      data: {
        page: newPage,
        action: "load_more_photos",
      },
      success: function (response) {
        // Insérez la nouvelle charge dans le conteneur des photos
        $("#load-moreContainer").before(response);

        // Mettez à jour la valeur de la page
        $("#btnLoad-more").data("page", newPage);

        // Réattacher l'événement "Charger plus" au nouveau bouton
        attachLoadMoreEvent();
      },
    });
  }

  // Fonction pour attacher l'événement "Charger plus"
  function attachLoadMoreEvent() {
    $("#load-moreContainer").on("click", "#btnLoad-more", function () {
      loadMoreContent();
    });
  }

  // Lorsque la page est chargée initialement
  attachLoadMoreEvent();
});

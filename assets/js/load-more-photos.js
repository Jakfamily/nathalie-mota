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
      },
    });
  }

  // Utiliser la délégation d'événement sur un parent stable
  $(document).on("click", "#load-moreContainer #btnLoad-more", function () {

    $("#load-moreContainer").hide('slow');

    if($("#btnLoad-more").data("filtered") == 1){
      changeFilter(true);
    } else {
      loadMoreContent();
    }
  });
});

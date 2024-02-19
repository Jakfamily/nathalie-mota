jQuery(function ($) {
  // Lorsque le bouton "Charger plus" est cliqué
  $("#plusDImage").on("click", function () {
    const page = $(this).data("page");
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
        $("#blockPusdImage").before(response);

        // Mettez à jour la valeur de la page
        $("#plusDImage").data("page", newPage);
      },
    });
  });
});

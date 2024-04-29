jQuery(function ($) {
  // Fonction pour gérer le chargement du contenu additionnel
  function loadMoreContent() {
    const offset = $("#btnLoad-more").data("offset");
    const ajaxurl = ajax_params.ajax_url;

    $.ajax({
      url: ajaxurl,
      type: "post",
      data: {
        offset: offset,
        action: "load_more_photos",
      },
      success: function (response) {
        // Insérez la nouvelle charge dans le conteneur des photos
        /*$("#load-moreContainer").before(response);*/
        
        if(response == 'Aucune photo trouvée.') {
          $("#btnLoad-more").hide();
        }
        else {
          $("#containerPhoto").append(response);
          attachEventsToImages();
          $("#btnLoad-more").data("offset", offset+8);
        }
       
        
      },
    });
  }

  // Utiliser la délégation d'événement sur un parent stable
  $(document).on("click", "#load-moreContainer #btnLoad-more", function () {
    loadMoreContent();
  });
});

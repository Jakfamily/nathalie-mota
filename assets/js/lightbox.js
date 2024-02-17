// Lightbox Ouverture et Fermeture
console.log("Lightbox Ouverture et Fermeture : son js est chargé");

$(function () {
  const $lightbox = $("#lightbox");
  const $lightboxImage = $(".lightboxImage");
  const $lightboxCategory = $(".lightboxCategorie");
  const $lightboxReference = $(".lightboxReference");
  let currentIndex = 0;

  function updateLightbox(index) {
    const $images = $(".fullscreen-icon");
    const $image = $images.eq(index);

    const categoryText = $image.data("category").toUpperCase();
    const referenceText = $image.data("reference").toUpperCase();

    $lightboxImage.attr("src", $image.data("full"));
    $lightboxCategory.text(categoryText);
    $lightboxReference.text(referenceText);
    currentIndex = index;
  }

  function openLightbox(index) {
    updateLightbox(index);
    $lightbox.show();
  }

  function closeLightbox() {
    $lightbox.hide();
  }

  window.attachEventsToImages = function () {
    const $images = $(".fullscreen-icon");
    $images.off("click", imageClickHandler);
    $images.on("click", imageClickHandler);
  };

  function imageClickHandler() {
    const $images = $(".fullscreen-icon");
    const index = $images.index($(this).closest(".fullscreen-icon"));
    openLightbox(index);
  }

  attachEventsToImages();

  $(".fermelightbox").on("click", closeLightbox);

  $(".lightboxPrecedent").on("click", function () {
    const $images = $(".fullscreen-icon");
    currentIndex = currentIndex > 0 ? currentIndex - 1 : $images.length - 1;
    updateLightbox(currentIndex);
  });

  $(".lightboxSuivant").on("click", function () {
    const $images = $(".fullscreen-icon");
    currentIndex = currentIndex < $images.length - 1 ? currentIndex + 1 : 0;
    updateLightbox(currentIndex);
  });
});

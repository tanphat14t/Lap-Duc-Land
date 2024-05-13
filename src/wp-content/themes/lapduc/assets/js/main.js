"use strict";
$ = jQuery;

$(document).ready(function () {
  header();
  slickSlide();
});
function header() {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
      $("#primary-header").addClass("scrolled");
    } else {
      $("#primary-header").removeClass("scrolled");
    }
  });

  // open hamburger menu
  if (screen.width < 992) {
    $(".btn-toggle .icon-bars").on("click", function (e) {
      e.preventDefault();
      $(".navbar-brand").addClass("showMenu");
      $(this).addClass("hidden");
      $(".btn-toggle .icon-close").removeClass("hidden");
      $(".menu-primary-menu-container").addClass("is-show");
    });
    $(".btn-toggle .icon-close").on("click", function (e) {
      e.preventDefault();
      $(".navbar-brand").removeClass("showMenu");
      $(this).addClass("hidden");
      $(".btn-toggle .icon-bars").removeClass("hidden");
      $(".menu-primary-menu-container").removeClass("is-show");
    });
  }
}

function slickSlide() {
  // slide Homepage
  if ($("#slick-slider-home").length) {
    $("#slick-slider-home").slick({
      dots: true,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            arrows: false,
          },
        },
      ],
    });
  }
  if ($(".list-post").length) {
    $(".list-post").slick({
      slidesToShow: 3,
      dots: false,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 1,
            arrows: false,
            dots: true,
          },
        },
      ],
    });
  }
  if ($(".slide-brands").length) {
    $(".slide-brands").slick({
      // autoplay: true,
      // autoplaySpeed: 1500,
      dots: false,
      arrows: false,
      slidesToShow: 4,
      autoplay: true,
      autoplaySpeed: 0,
      speed: 8000,
      pauseOnHover: false,
      cssEase: "linear",
      responsive: [
        {
          breakpoint: 769,
          settings: {
            slidesToShow: 2,
          },
        },
      ],
    });
  }

  // slide about page
  if ($(".about-ssTwo-slide").length) {
    $(".about-ssTwo-slide").slick({
      dots: true,
      slidesToShow: 1,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            arrows: false,
          },
        },
      ],
    });
  }
  if ($(".slick-slide-image").length) {
    $(".slick-slide-image").slick({
      dots: false,
      arrows: false,
      slidesToShow: 4,
      autoplay: true,
      autoplaySpeed: 0,
      speed: 8000,
      pauseOnHover: false,
      cssEase: "linear",
    });
  }

  // slide Jewelry
  let splideStoreImages = $(".splide__store");
  if (splideStoreImages.length) {
    var stores = new Splide(".splide__store", {
      perPage: 1,
      type: "fade",
      pagination: false,
      arrows: true,
      // drag: false,
      breakpoints: {
        768: {
          arrows: false,
          pagination: true,
        },
      },
    });
    stores.mount();
  }
  if ($(".gallery-image").length) {
    var elms = document.getElementsByClassName("gallery-image");
    for (var i = 0, len = elms.length; i < len; i++) {
      var elmSplideMain = elms[i].getElementsByClassName(
        "splide-image__store"
      )[0];
      var elmSplideThumbnail = elms[i].getElementsByClassName(
        "splide-image__store--thumb"
      )[0];
      var splideMain = new Splide(elmSplideMain, {
        type: "loop",
        perPage: 1,
        pagination: false,
        arrows: false,
        gap: 28,
        padding: {
          right: "25%",
          left: "25%",
        },
        breakpoints: {
          991: {
            padding: {
              right: "16%",
              left: "16%",
            },
          },
          768: {
            arrows: false,
            padding: {
              right: 0,
              left: 0,
            },
          },
        },
      });
      var splideThumbnail = new Splide(elmSplideThumbnail, {
        rewind: false,
        perPage: 9,
        isNavigation: true,
        gap: 20,
        pagination: false,
        arrows: true,
        cover: true,
        padding: {
          right: 80,
        },
        breakpoints: {
          991: {
            perPage: 6,
            gap: 8,
            padding: {
              right: 40,
            },
          },
          768: {
            perPage: 4,
            arrows: false,
            gap: 4,
            padding: {
              right: 40,
            },
          },
        },
      });

      splideMain.sync(splideThumbnail);
      splideMain.mount();
      splideThumbnail.mount();
    }
  }
}

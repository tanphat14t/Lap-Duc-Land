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
}

"use strict";
$ = jQuery;

$(document).ready(function () {
  header();
  slideHome();
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

function slideHome() {
  if ($("#slick-slider-home").length) {
    $("#slick-slider-home").slick({
      dots: true,
    });
  }
  if ($(".list-post").length) {
    $(".list-post").slick({
      slidesToShow: 3,
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
    });
  }
}

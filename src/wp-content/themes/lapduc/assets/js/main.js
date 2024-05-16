"use strict";
$ = jQuery;

$(document).ready(function () {
  header();
  slickSlide();
  loadmoreRecruiment();
  paginationPost();
  loadmorePostDetail();
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
      $("body").addClass("overflow-hidden");
    });
    $(".btn-toggle .icon-close").on("click", function (e) {
      e.preventDefault();
      $("body").removeClass("overflow-hidden");
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
      drag: false,
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
        type: "loop",
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

  // news
  if ($(".outstanding .list-news").length && screen.width < 992) {
    $(".outstanding .list-news").slick({
      slidesToShow: 3,
      dots: false,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            arrows: false,
            dots: false,
          },
        },
        {
          breakpoint: 525,
          settings: {
            slidesToShow: 1,
            arrows: false,
            dots: false,
          },
        },
      ],
    });
  }

  // bat dong san
  if ($(".slide-area").length) {
    $(".slide-area").slick({
      slidesToShow: 3,
      dots: false,
      settings: "unslick",
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            arrows: false,
            dots: true,
          },
        },
        {
          breakpoint: 525,
          settings: {
            slidesToShow: 1,
            arrows: false,
            dots: true,
          },
        },
      ],
    });
  }
}

function loadmoreRecruiment() {
  var offset = 4;
  $(".loadmore-recruiment").on("click", function (e) {
    e.preventDefault();

    $.ajax({
      type: "post",
      dataType: "html",
      async: true,
      url: ajaxUrl,
      data: {
        action: "loadmore_recruiment",
        offset: offset,
      },
      beforeSend: function () {
        $(".loadmore-recruiment .loader").removeClass("d-none");
        $(".loadmore-recruiment").prop("disabled", true);
      },
      success: function (response) {
        if (response.trim().length > 0) {
          $(".recruiment .page-container .row").append(response);
          offset += 4;
          $(".loadmore-recruiment .loader").addClass("d-none");
          $(".loadmore-recruiment").prop("disabled", false);
        } else {
          // No more posts
          $(".loadmore-recruiment").hide();
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("The following error occurred: " + textStatus, errorThrown);
      },
    });
  });
}
function loadmorePostDetail() {
  var offset = 4;
  $(".single-detail .button-view-more a").on("click", function (e) {
    e.preventDefault();
    let idPost = $(this).data("id");
    $.ajax({
      type: "post",
      dataType: "html",
      async: true,
      url: ajaxUrl,
      data: {
        action: "loadmore_postdetail",
        offset: offset,
        idPost: idPost,
      },
      beforeSend: function () {},
      success: function (response) {
        if (response.trim().length > 0) {
          $(".single-detail .list").append(response);
          offset += 4;
        } else {
          // No more posts
          $(".single-detail .button-view-more").hide();
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("The following error occurred: " + textStatus, errorThrown);
      },
    });
  });
}
function paginationPost() {
  $("body").on(
    "click",
    ".knowledge .custom-pagination a.page-numbers",
    function (e) {
      e.preventDefault();
      var href = $(this).attr("href");
      var paged = detectUrlType(href);
      $.ajax({
        type: "post",
        dataType: "html",
        async: true,
        url: ajaxUrl,
        data: {
          action: "pagination",
          paged: paged,
        },
        beforeSend: function () {},
        success: function (response) {
          if (response) {
            $(".knowledge .wrapper-post").html(response);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(
            "The following error occurred: " + textStatus,
            errorThrown
          );
        },
      });
    }
  );
}

function detectUrlType(url) {
  var ajaxUrlRegex = /admin-ajax\.php\?paged=\d+/;
  var pageUrlRegex = /\/page\/\d+\/?$/;
  let number = "";
  if (ajaxUrlRegex.test(url)) {
    number = getParameterValueFromUrl(url);
    return number;
  } else if (pageUrlRegex.test(url)) {
    number = getPageNumberFromUrl(url);
    return number;
  } else {
    return "unknown";
  }
}
function getPageNumberFromUrl(url) {
  var queryRegex = /[?&]paged=(\d+)/;
  var urlRegex = /\/(\d+)\/?$/;

  var queryMatch = url.match(queryRegex);
  if (queryMatch) {
    return queryMatch[1];
  }

  var urlMatch = url.match(urlRegex);
  if (urlMatch) {
    return urlMatch[1];
  }

  return null;
}
function getParameterValueFromUrl(url) {
  var queryString = url.split("?")[1];
  if (!queryString) return null;

  var parameters = queryString.split("&");

  for (var i = 0; i < parameters.length; i++) {
    var parameterParts = parameters[i].split("=");
    if (parameterParts[0] === "paged") {
      return parameterParts[1];
    }
  }
  return null;
}

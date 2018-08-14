(function($) {
  "use strict";
  var items = [];
  $(document).ready(function() {
  	myresize();
  $(window).resize(function() {
      myresize();
    });

    $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
      nextArrow: '<img class="slick_next" src="http://localhost/koryfo/web-assets/uploads/2018/08/arrow.png" />',
      prevArrow: '<img class="slick_prev" src="http://localhost/koryfo/web-assets/uploads/2018/08/arrow.png" />',
      slidesToShow: 5,
      slidesToScroll: 1,
      asNavFor: '.slider-for',
      dots: true,
      centerMode: true,
      focusOnSelect: true,
      vertical: true,
      dots: false,
      autoplay: true,
      autoplaySpeed: 2000,
      responsive: [{
        breakpoint: 750,
        settings: {
          vertical: false,
          slidesToShow: 1,
          centerMode: false,
          centerPadding: '60px',
        }
      }]
    });

  });
  
  if ($('.hamburger').length > 0) {
    $('.hamburger').click(function () {
      if ($(this).hasClass('is-active')) {
        $('.hamburger').removeClass('is-active');
      }
      else {
        $('.hamburger').addClass('is-active');
      }
    });
  }

  if ($('.partners_carousel').length > 0) {
    setTimeout(function () {
      slider_slick('.partners_carousel');
    }, 1000);
  }
  if ($('.img_gallery').length > 0) {
    setTimeout(function () {
      slider_slick('.img_gallery');
    }, 1000);
  }
  

  /*bruteforce --- properties map script*/
  if ($('#map_wrapper').length > 0) {
    if ($('.coordinates').length > 0) {
      setTimeout(function () { 
        google_map_initialize();    
      }, 1000);
    }
  }

            if ($('.img_gallery').length > 0) {
              var photoSwipe = $(".pswp").html();
              $('body').prepend('<div class="pswp">' + photoSwipe + '</div>');

              var gallery = '';
              var options = {
                // history & focus options are disabled on CodePen
                history: false,
                focus: false,

                showAnimationDuration: 0,
                hideAnimationDuration: 0

              };

              var openPhotoSwipe = function (k) {

                var pswpElement = document.querySelectorAll('.pswp')[0];

                // build items array
                if (items.length == 0) {


                  $('.img_gallery [data-sbp_pswp]').each(function () {
                    if (!($(this).closest('.slick-slide').hasClass('slick-cloned'))) {
                      if ($(this).is('img')) {
                        var image = $(this).closest('img');
                        var the_image = new Image();
                        the_image.src = image.attr('src');
                        var imageWidth = $(this).attr('data-natural_width');
                        var imageHeight = $(this).attr('data-natural_height');

                        items.push({
                          src: the_image.src,
                          w: imageWidth,
                          h: imageHeight
                        });

                        //     }
                        $(this).closest('.img_gallery').attr('data-photoswipe', $(this).closest('img').attr('src'));
                      } else {
                        var video_url = $(this).attr('data-url');
                        items.push({
                          html: '<div class="sbp_video-container"><div class="sbp_video-wrapper"><video class="pswp__video" src="' + video_url + '" controls muted preload="auto" autoplay></video></div></div>'
                        });
                      }
                    }
                  });


                }
                // define options (if needed)

                gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);


                gallery.init();

                if (k != '') {
                  var key = $.map(items, function (obj, index) {
                    if (obj.src == k) {

                      return index;
                    }
                  });
                  if (key.length == 0) {
                    key = 0;
                  }

                  gallery.goTo(parseInt(key));


                }

              };

              $(document).on('click', '.img_gallery [data-sbp_pswp]', function () {
                openPhotoSwipe($(this).attr('src'));
              });

            }
 function myresize() {

  }

  function google_map_initialize() {
    var coordinates_string = $('.coordinates').text();
    var markers = JSON.parse(coordinates_string);

    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
      mapTypeId: 'roadmap',
      zoom: 16,
      styles: [
        {
          "featureType": "all",
          "stylers": [
            {
              "saturation": 0
            },
            {
              "hue": "#e7ecf0"
            }
          ]
        },
        {
          "featureType": "road",
          "stylers": [
            {
              "saturation": -70
            }
          ]
        },
        {
          "featureType": "transit",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "poi",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "water",
          "stylers": [
            {
              "visibility": "simplified"
            },
            {
              "saturation": -60
            }
          ]
        }
      ]
    };

    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(),
      marker, i;
    // Loop through our array of markers & place each one on the map

    for (i = 0; i < markers.length; i++) {
      var position = new google.maps.LatLng(markers[i]['lat'], markers[i]['lng']);
      bounds.extend(position);
      marker = new google.maps.Marker({
        position: position,
        map: map,
        icon: 'http://localhost/koryfo/web-assets/uploads/2018/08/logo_map_koryfo.png',
        title: 'koryfo'
      });

      // Automatically center the map fitting all markers on the screen
      map.fitBounds(bounds);

    }
  }

  function slider_slick(element) {
    if ($(element).length > 0) {
      var columns = $(element).data('columns');
      var mcolumns = $(element).data('mcolumns');
      var scolumns = $(element).data('scolumns');

      $(element).not('.slick-initialized').slick({
        nextArrow: '',
        prevArrow: '',
        slidesToShow: columns,
        dots: false,
        speed: 400,
        infinite: true,
        swipeToSlide: true,
        variableWidth: false,
        centerMode: false,
        centerPadding: '30px',
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
          breakpoint: 1100,
          settings: {
            slidesToShow: mcolumns,
            slidesToScroll: 1,
            autoplay: false
          }
        }, {
          breakpoint: 750,
          settings: {
            slidesToShow: scolumns,
            slidesToScroll: 1,
          //  autoplay: false
          }
        }, {
          breakpoint: 550,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          //  centerMode: true,
            autoplay: false
          }
        }]
      });

    }
  }

})(jQuery);
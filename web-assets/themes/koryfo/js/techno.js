(function ($) {
 "use strict";
 var items, numAnim;

 $(document).ready(function () {

  $(window).resize(function () {
   myresize();
  });
  //Barba.Dispatcher.on('newPageReady', function () { this uncomment for barba
 
   	var counterObjects = {};
   items = [];
   myresize();
   setTimeout(function () {
    if ($('.img_gallery').length > 0) {
     slider_slick('.img_gallery');
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
    if ($('.slider-for').length > 0) {
     $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.slider-nav'
     });

     $('.slider-nav').slick({
      nextArrow: '<img class="slick_next" src="' + techno_site + '/web-assets/uploads/2018/08/arrow.png" />',
      prevArrow: '<img class="slick_prev" src="' + techno_site + '/web-assets/uploads/2018/08/arrow.png" />',
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
    }

    if ($('.partners_carousel').length > 0) {
     slider_slick('.partners_carousel');
    }

    /*bruteforce --- properties map script*/
    if ($('#map_wrapper').length > 0) {
     if ($('.coordinates').length > 0) {
      setTimeout(function () {
       google_map_initialize();
      }, 1000);
     }
    }




   }, 1000);




   if ($('.hamburger').length > 0) {
    $('.hamburger').click(function () {
     if ($(this).hasClass('is-active')) {
      $('.hamburger').removeClass('is-active');
     } else {
      $('.hamburger').addClass('is-active');
     }
    });
   }



setTimeout(function () {
 $('#bodymovin').slideUp('250');
 $('body').addClass('showthis');
}, 3500);
   


  //}); this uncomment for barba


 });

 function google_map_initialize() {
  var coordinates_string = $('.coordinates').text();
  var markers = JSON.parse(coordinates_string);

  var map;
  var bounds = new google.maps.LatLngBounds();
  var mapOptions = {
   mapTypeId: 'roadmap',
   zoom: 16,
   styles: [{
     "featureType": "all",
     "stylers": [{
       "saturation": 0
      },
      {
       "hue": "#e7ecf0"
      }
     ]
    },
    {
     "featureType": "road",
     "stylers": [{
      "saturation": -70
     }]
    },
    {
     "featureType": "transit",
     "stylers": [{
      "visibility": "off"
     }]
    },
    {
     "featureType": "poi",
     "stylers": [{
      "visibility": "off"
     }]
    },
    {
     "featureType": "water",
     "stylers": [{
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
    icon: techno_site + '/web-assets/uploads/2018/08/MAP-e1534418839593.png',
    title: 'koryfo',
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

 function myresize() {

 }


})(jQuery);

/*

all barba code needed

Barba.Pjax.start();
Barba.Prefetch.init();


var FadeTransition = Barba.BaseTransition.extend({
 start: function () {
 
   * This function is automatically called as soon the Transition starts
   * this.newContainerLoading is a Promise for the loading of the new container
   * (Barba.js also comes with an handy Promise polyfill!)
 

  // As soon the loading is finished and the old page is faded out, let's fade the new page
  Promise
   .all([this.newContainerLoading, this.fadeOut()])
   .then(this.fadeIn.bind(this));
 },

 fadeOut: function () {
  return $(this.oldContainer).animate({
   opacity: 0.8
  }, 1000).promise();
 },

 fadeIn: function () {

   * this.newContainer is the HTMLElement of the new Container
   * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
   * Please note, newContainer is available just after newContainerLoading is resolved!
  

  $(window).scrollTop(0);
  var _this = this;
  var $el = $(this.newContainer);

  $(this.oldContainer).hide();

  $el.css({
   visibility: 'visible',
   opacity: 0.8
  });

  $el.animate({
   opacity: 1
  }, 200, function () {
   
    * Do not forget to call .done() as soon your transition is finished!
    * .done() will automatically remove from the DOM the old Container
    

   _this.done();
  });
 }
});


 * Next step, you have to tell Barba to use the new Transition


Barba.Pjax.getTransition = function () {

  * Here you can use your own logic!
  * For example you can use different Transition based on the current page or link...


 return FadeTransition;
};


*/
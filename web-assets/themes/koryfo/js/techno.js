 "use strict";
var items, numAnim;
var swidth = 0;
var running = 0;
var boxList = [];
var count = 0;
var options = {
  useEasing: true,
  useGrouping: true,
  separator: ',',
  decimal: '.',
};
var infoWindows = [];

  
 //Barba.Dispatcher.on('newPageReady', function () { /*uncomment this to remove barba*/
   check_sticky();
   openNav();

/*main_event*/
window.onscroll = function () {
    setTimeout(sticky_it(), 300);
}

   items = [];
   myresize();

   jQuery(window).resize(function () {
     myresize();
   });


  jQuery(window).scroll(function () {
    if (isScrolledIntoView(jQuery('.anim_numbers'))) {
      if (jQuery('.anim_numbers').length > 0) {
        jQuery('.anim_numbers').each(function (index) {
          if (!(jQuery(this).hasClass('animated'))) {
          var id = jQuery(this).attr('id');
          var start = jQuery(this).attr('data-start');
          var final = jQuery(this).attr('data-final');
          var decimals = jQuery(this).attr('data-decimals');
          var duration = jQuery(this).attr('data-duration');

          var number = new CountUp(id, start, final, decimals, duration, options);
          if (!number.error) {
            number.start();
          } else {
            console.error(number.error);
          }
          jQuery(this).addClass('animated');
          }
        });
      }
    }
  });


   jQuery('.side_msg').each(function (index) {
     var width = jQuery(this).width();
     var final_width = width + 20;
     jQuery(this).css('top', final_width + 'px');
   });

   setTimeout(function () {
    
    if (jQuery('.img_gallery').length > 0) {
      count++;
      $('.img_gallery').addClass('count_'+count);
     
     console.log('img_gallery');


     slider_slick('.count_' + count);
     if (count == 1) { 
      var photoSwipe = jQuery(".pswp").html();
      jQuery('body').prepend('<div class="pswp">' + photoSwipe + '</div>');
    }

     
     
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
       jQuery('.count_'+ count + ' [data-sbp_pswp]').each(function () {
        if (!(jQuery(this).closest('.slick-slide').hasClass('slick-cloned'))) {
         if (jQuery(this).is('img')) {
          var image = jQuery(this).closest('img');
          var the_image = new Image();
          the_image.src = image.attr('src');
          var imageWidth = jQuery(this).attr('data-natural_width');
          var imageHeight = jQuery(this).attr('data-natural_height');

          items.push({
           src: the_image.src,
           w: imageWidth,
           h: imageHeight
          });

          //     }
          jQuery(this).closest('.count_' + count ).attr('data-photoswipe', jQuery(this).closest('img').attr('src'));
         } else {
          var video_url = jQuery(this).attr('data-url');
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

     jQuery(document).on('click', '.count_' + count + ' [data-sbp_pswp]', function () {
        openPhotoSwipe(jQuery(this).attr('src'));
     });
    }
     if (jQuery('.projects_slider .slider-for').length > 0) {
       console.log('projects_slider');
     count++;
       $('.projects_slider .slider-for').addClass('count_' + count);
       $('.projects_slider .slider-nav').addClass('count_' + count);
       jQuery('.projects_slider .slider-for.count_' + count ).slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
         asNavFor: '.projects_slider .slider-nav'
     });

      jQuery('.projects_slider .slider-nav.count_' + count).slick({
      nextArrow: '<i class="slick_next  fa fa-angle-right slick-left" ></i>',
      prevArrow: '<i class="slick_prev fa fa-angle-left slick-right"></i>',
      slidesToShow: 5,
      slidesToScroll: 1,
      asNavFor: '.projects_slider .slider-for',
      dots: true,
      centerMode: true,
      focusOnSelect: true,
      vertical: true,
      dots: false,
      autoplay: true,
      autoplaySpeed: 4000,
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
     if (jQuery('.services_slider .slider-for').length > 0) {
       console.log('services_slider');
       /*
       count++;
       $('.services_slider .slider-for').addClass('count_'+count);
       $('.services_slider .slider-nav').addClass('count_' + count);
       */
       jQuery('.services_slider .slider-for').slick({
         slidesToShow: 1,
         slidesToScroll: 1,
         arrows: false,
         fade: true,
         dots: true,
         asNavFor: '.services_slider .slider-nav'
       });

       jQuery('.services_slider .slider-nav').slick({
         nextArrow: '<i class="slick_next  fa fa-angle-right slick-left" ></i>',
         prevArrow: '<i class="slick_prev fa fa-angle-left slick-right"></i>',
         slidesToShow: 1,
         slidesToScroll: 1,
         asNavFor: '.services_slider .slider-for',
         dots: true,
         centerMode: false,
         focusOnSelect: true,
         vertical: false,
         dots: false,
         centerPadding: '60px',
         autoplay: true,
         autoplaySpeed: 4000
       });
     }
    if (jQuery('.partners_carousel').length > 0) {
      console.log('partners');
      count++;
      $('.partners_carousel').addClass('count_'+count);
      partners_slick('.count_' + count);
    }

    /*bruteforce --- properties map script*/
    if (jQuery('#map_wrapper').length > 0) {
     if (jQuery('.coordinates').length > 0) {
      setTimeout(function () {
        console.log('map');
       google_map_initialize();
      }, 1000);
     }
    }
   }, 800);


   if (jQuery('.hamburger').length > 0) {
    jQuery('.hamburger').click(function () {
     if (jQuery(this).hasClass('is-active')) {
      jQuery('.hamburger').removeClass('is-active');
     } else {
      jQuery('.hamburger').addClass('is-active');
     }
    });
   }



setTimeout(function () {
 jQuery('#bodymovin').slideUp('250');
 jQuery('body').addClass('showthis');
}, 3500);
   


 //});  

  /*start removing for barba*/
  /*initialize barba*//*
  Barba.Pjax.start();
  Barba.Prefetch.init();


  var FadeTransition = Barba.BaseTransition.extend({
    start: function () {
      /**
       * This function is automatically called as soon the Transition starts
       * this.newContainerLoading is a Promise for the loading of the new container
       * (Barba.js also comes with an handy Promise polyfill!)
       */

      // As soon the loading is finished and the old page is faded out, let's fade the new page 
      /*
      if (jQuery('.krf_limit_text').length > 0) {
        jQuery('.krf_limit_text').each(function (index) {
          shave_text(this);
        });
      }
      Promise
        .all([this.newContainerLoading, this.fadeOut()])
        .then(this.fadeIn.bind(this));
    },

    fadeOut: function () {
      return jQuery(this.oldContainer).animate({
        opacity: 0.8
      }, 100).promise();
    },

    fadeIn: function () {
      /**
       * this.newContainer is the HTMLElement of the new Container
       * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
       * Please note, newContainer is available just after newContainerLoading is resolved!
       */
/*
      jQuery(window).scrollTop(0);
      var _this = this;
      var $el = jQuery(this.newContainer);

      jQuery(this.oldContainer).hide();

      $el.css({
        visibility: 'visible',
        opacity: 0.8
      });

      $el.animate({
        opacity: 1
      }, 200, function () {
        /**
         * Do not forget to call .done() as soon your transition is finished!
         * .done() will automatically remove from the DOM the old Container
         */
/*
        _this.done();
      });
    }
  });

  /**
   * Next step, you have to tell Barba to use the new Transition
   */
  /*
  Barba.Pjax.getTransition = function () {
    /**
     * Here you can use your own logic!
     * For example you can use different Transition based on the current page or link...
     */
/*
    return FadeTransition;
  };
*/
/*stop removing for barba*/



 function google_map_initialize() {
  var coordinates_string = jQuery('.coordinates').text();
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
  var marker, i;
  // Loop through our array of markers & place each one on the map

  for (i = 0; i < markers.length; i++) {
   var position = new google.maps.LatLng(markers[i]['lat'], markers[i]['lng']);
   bounds.extend(position);
   if (markers[i]['link'] === '') {
     var project_title = '<h5>' + markers[i]['title'] + '</h5>';
   }
   else {
     var project_title = '<a href="'+ markers[i]['link'] +'" class="link_color_1"><h5>' + markers[i]['title'] + '</h5></a>';
   }
    var contentString = '<div id="point_content"><div class="title">'+ project_title +'</div>' + markers[i]['text'] + '</div>';
    var infowindow = new google.maps.InfoWindow();
    infoWindows.push(infowindow);
   marker = new google.maps.Marker({
    position: position,
    map: map,
    icon: techno_site + '/web-assets/uploads/2018/08/MAP-e1534418839593.png',
    title: 'techno',
   });
   // Automatically center the map fitting all markers on the screen

    google.maps.event.addListener(marker, 'click', (function (marker, contentString, infowindow) {
        return function () {
          closeAllInfoWindows();
          setTimeout(function () {
            infowindow.setContent(contentString);
            infowindow.open(map, marker);       
          }, 100);

        };
    })(marker, contentString, infowindow));




  }
   map.fitBounds(bounds);

 }

  function closeAllInfoWindows() {
    for (var i = 0; i < infoWindows.length; i++) {
      infoWindows[i].close();
    }
  }

 function slider_slick(element) {
  if (jQuery(element).length > 0) {
  /*  
   var columns = jQuery(element).data('columns');
   var mcolumns = jQuery(element).data('mcolumns');
   var scolumns = jQuery(element).data('scolumns');
*/
   jQuery(element).not('.slick-initialized').slick({
    nextArrow: '<i class="slick_next  fa fa-angle-right slick-left" ></i>',
    prevArrow: '<i class="slick_prev fa fa-angle-left slick-right"></i>',
    slidesToShow: 1,
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
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false
     }
    }, {
     breakpoint: 750,
     settings: {
      slidesToShow: 1,
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
  function partners_slick(element) {
    if (jQuery(element).length > 0) {

      jQuery(element).not('.slick-initialized').slick({
        nextArrow: '<i class="slick_next  fa fa-angle-right slick-left" ></i>',
        prevArrow: '<i class="slick_prev fa fa-angle-left slick-right"></i>',
        slidesToShow: 4,
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
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false
          }
        }, {
          breakpoint: 750,
          settings: {
            slidesToShow: 1,
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

   function shave_text(element) {
     var current_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
     var original_text = jQuery(element).attr('data-original_text');
     var elements = [{
       elem: 'krf_limit_text',
       minwidth: 1,
       maxwidth: 3000,
       original_text: original_text
     }];


     if (current_width !== swidth) {
       $.each(elements, function (i, clss) {
         if (jQuery('.' + clss.elem).length) {
           var cld = '.' + clss.elem + '.shaved';
           var clnd = '.' + clss.elem + ':not(.shaved)';
           var hh = 40;
           if (jQuery(cld).length) {
             shave(cld, hh);
             jQuery(cld).removeClass('shaved');
           }
           if (current_width >= clss.minwidth && ((clss.maxwidth > current_width && clss.maxwidth > 0) || clss.maxwidth == 0)) {
             jQuery(clnd).each(function () {

               //  if (current_width < 768) {
               //    hh += 20;
               // } else {
               if (jQuery(this).attr('data-height')) {
                 hh = parseInt(jQuery(this).attr('data-height'));
               }
               // }
               //jQuery(this).text(clss.original_text);
               shave(this, hh, {
                 classname: clss.elem
               });
               jQuery(this).addClass('shaved');

               if (jQuery(this).attr('data-link')) {
                 setTimeout(function () {
                   jQuery('.krf_limit_text.removed[data-link]').each(function (index) {
                     jQuery('<a href="' + jQuery(this).attr('data-link') + '" class="read_more">  ' + jQuery(this).attr('data-more_txt') + '</a>').appendTo(this);
                     jQuery(this).removeClass('removed');

                   });
                 }, 600);
               }
             });
           }
         }
       });
       swidth = current_width;
     }
   }

   function isScrolledIntoView(elem) {
     if (jQuery(elem).length)
     {

     
     var docViewTop = jQuery(window).scrollTop();
     var docViewBottom = docViewTop + jQuery(window).height();

     var elemTop = jQuery(elem).offset().top;
     var elemBottom = elemTop + jQuery(elem).height();

     return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
     }
   }


 function myresize() {
    if (jQuery('.krf_limit_text').length > 0) {
      jQuery('.krf_limit_text').each(function (index) {
        shave_text(this);
      });
    }
 }




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
  return jQuery(this.oldContainer).animate({
   opacity: 0.8
  }, 1000).promise();
 },

 fadeIn: function () {

   * this.newContainer is the HTMLElement of the new Container
   * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
   * Please note, newContainer is available just after newContainerLoading is resolved!
  

  jQuery(window).scrollTop(0);
  var _this = this;
  var $el = jQuery(this.newContainer);

  jQuery(this.oldContainer).hide();

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


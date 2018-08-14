/*global variables*/
var navbar = document.getElementById("masthead");
var content = document.getElementById("content");
var sticky = navbar.offsetTop;
var running = 0;
var lastscroll = 0;
var st = 0;
var stick = 0;

/*function to play*/
function sticky_it() {

    check_sticky();

    running = 1;
    var dis_stick = stick == 1 ? 1 : 0;
    /*check previous scroll position*/
    st = window.pageYOffset || document.documentElement.scrollTop;

  //  if (lastscroll > st) {
        /*if we have scroll up*/

        if (st >= sticky) {
            /*if we don't see the menu*/
            dis_stick = 0;
            if (stick === 0) {
                /*if no sticky before*/
                navbar.classList.add("sticky");
                stick = 1;

                //var height = navbar.clientHeight;
                //content.style.marginTop = height + 'px';
            }

        }
//    }
    
    if (stick == 2 || dis_stick == 1) {
        navbar.classList.remove("sticky");
        stick = 0;
        content.style.marginTop = '';
    }
    
    running = 0;
    lastscroll = st;
}

/*main_event*/
window.onscroll = function () {
    if (running == 0) {
        setTimeout(sticky_it(), 300);
    }
}

check_sticky();

function openNav() {
    setTimeout(function () {
        if ($('.js-hamburger.is-active').length > 0) {
            document.getElementById("site-navigation-mobile").style.width = "100%";
        }
        else {
            document.getElementById("site-navigation-mobile").style.width = "0";
        }
    }, 350);
}

function check_sticky() {
    if ($('body.home').length > 0) {
        if ($(window).scrollTop() > $(window).height()) {
            $('#masthead').show();
            if ($('#masthead.sticky').length == 0) {
                $('#masthead').addClass('sticky');
            }
        } else {
            $('#masthead').hide();
            if ($('#masthead.sticky').length > 0) {
                $('#masthead').removeClass('sticky');
            }
        }
    } else {
        if ($('#masthead.sticky').length == 0) {
                $('#masthead').addClass('sticky');
        }
    }
    
}


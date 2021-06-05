$=jQuery
jQuery(document).ready(function () {



  /* search toggle */
        $('body').click(function(evt){
          if(!( $(evt.target).closest('.search-section').length || $(evt.target).hasClass('search-toggle') ) ){
           if ($(".search-toggle").hasClass("search-active")){
            $(".search-toggle").removeClass("search-active");
            $(".search-box").slideUp("slow");
          }
        }
        });
        $(".search-toggle").click(function(e){
        $(".search-box").toggle("slow");
             if ( !$(".search-toggle").hasClass("search-active")){
// 				   $(".search-toggle").addClass("search-active");
						Headers_search();
				 
				}
        	else{
					$(".search-toggle").removeClass("search-active");
				}
        
    });
	function Headers_search(e) {
        $('.search-toggle').toggleClass('search-active');
		setTimeout(function(){
        $('.search-section form input[type="search"]').focus();
			}, 500 );
        var focusableEls = $('.search-section a[href]:not([disabled]), .search-section input[type="submit"]:not([disabled]), .search-section input:not([disabled]) ');
        var firstFocusableEl = focusableEls[0];
        var lastFocusableEl = focusableEls[focusableEls.length - 1];
        var KEYCODE_TAB = 9;
        $('.search-section').on('keydown', function (e) {
            if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {

                if ( e.shiftKey && document.activeElement === lastFocusableEl ) {
                  e.preventDefault();
                  $('.search-section form input[type="search"]').focus();
                } else {
                  if (document.activeElement === lastFocusableEl) {
//                       firstFocusableEl.focus();
                      e.preventDefault();
                      $('.search-toggle').removeClass('search-active');
                  }
                }    
            }
        });
    }

	$(document).on('keyup', function(e){
		 if ( e.keyCode === 27 && $('.search-toggle').hasClass('search-active') ) {
           $(".search-toggle").removeClass("search-active");
        }
//         removeClass = true;
	});

  jQuery('.menu-top-menu-container').meanmenu({
    meanMenuContainer: '.main-navigation',
    meanScreenWidth:"767",
    meanRevealPosition: "right",
  });


         /* back-to-top button*/

     $('.back-to-top').hide();
     $('.back-to-top').on("click",function(e) {
     e.preventDefault();
     $('html, body').animate({ scrollTop: 0 }, 'slow');
    });

    
    $(window).scroll(function(){
      var scrollheight =400;
      if( $(window).scrollTop() > scrollheight ) {
           $('.back-to-top').fadeIn();

          }
        else {
              $('.back-to-top').fadeOut();
             }
     });

    


           // slider

           var owllogo = $("#owl-slider-demo");

              owllogo.owlCarousel({
                  items:1,
                  loop:true,
                  nav:true,
                  dots:false,
                  smartSpeed:900,
                  // autoplay:true,
                  // autoplayTimeout:5000,
                  fallbackEasing: 'easing',
                  transitionStyle : "fade",
                  autoplayHoverPause:true,
                  animateOut: 'fadeOut'
              });


             var owl = $("#clients-slider");
              owl.owlCarousel({
              items:3,
              loop:true,
              nav:true,
              dots:false,
              smartSpeed:900,
              autoplay:true,
              autoplayTimeout:1300,
              fallbackEasing: 'easing',
              transitionStyle : "fade",
              autoplayHoverPause:true,
              responsive:{
                  0:{
                      items:1
                  },
                  580:{
                      items:3
                  },
                  1000:{
                      items:4
                  }
              }
              
              });


              $('.play').on('click', function() {
                owl.trigger('play.owl.autoplay', [1000])
              })
              $('.stop').on('click', function() {
                owl.trigger('stop.owl.autoplay')
              })


              

    /* for counter */

    function count($this){
      var current = parseInt($this.html(), 10);
      current = current + 1; /* Where 1 is increment */

      $this.html(++current);
      if(current > $this.data('count')){
        $this.html($this.data('count'));
      } else {
        setTimeout(function(){count($this)}, 50);
      }
    }

    jQuery(".start-count").each(function() {
      jQuery(this).data('count', parseInt(jQuery(this).html(), 10));
      jQuery(this).html('0');
      count(jQuery(this));
    });

    $('#mixit-container').mixItUp();
	
// 	meanmenu focus
	
	  $('.mean-bar').on('keydown', function (e) {

      $(".sub-menu").attr("aria-expanded", "true");
      var focusableEls = $(' .mean-bar .meanmenu-reveal, .mean-bar a[href]:not([disabled]), .mean-bar li');
      var firstFocusableEl = focusableEls[0];
      var lastFocusableEl = focusableEls[focusableEls.length - 1];


      var KEYCODE_TAB = 9;
      if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {

          if (e.shiftKey) /* shift + tab */ {
              if (document.activeElement === firstFocusableEl) {
//                   lastFocusableEl.focus();
//                   e.preventDefault();
              }
          } else /* tab */ {
              if (document.activeElement === lastFocusableEl) {
                  firstFocusableEl.focus();
                  e.preventDefault();
              }
          }
      }

  });
	

        
});
 
// top toggle bar

	$('.top-menu-toggle_trigger').on('click', function(){
	  $(this).toggleClass('close');
	 
		top_toggle();
	});
	function top_toggle(e) {
		 $('.top-menu-toggle_body_wrapper').slideToggle().toggleClass('hide-menu');
			var focusableEls = $('.top-menu-toggle_bar_wrapper a[href]:not([disabled]),.top-menu-toggle_body_wrapper a[href]:not([disabled]');
			var firstFocusableEl = focusableEls[0];
			var lastFocusableEl = focusableEls[focusableEls.length - 1];
			var KEYCODE_TAB = 9;
		console.log(firstFocusableEl);
		console.log(lastFocusableEl);
			$('.top-menu-toggle_body_wrapper').on('keydown', function (e) {
				if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
// 					  if (document.activeElement === lastFocusableEl) {
// 						  e.preventDefault();
// 						   $('.top-menu-toggle_trigger').removeClass('close');
// 						   $('.top-menu-toggle_body_wrapper').slideToggle().toggleClass('hide-menu');

// 					  }
					if ( e.shiftKey ) /* shift + tab */ {
            if (document.activeElement === firstFocusableEl) {
                lastFocusableEl.focus();
                e.preventDefault();
            }
        } else /* tab */ {
            if (document.activeElement === lastFocusableEl) {
                firstFocusableEl.focus();
                e.preventDefault();
            }
        }
					    
				}
			});
	}

	$(document).on('keyup', function(e){
		 if ( e.keyCode === 27 && $('.top-menu-toggle_trigger').hasClass('close') ) {
            $('.top-menu-toggle_trigger').removeClass('close');
			$('.top-menu-toggle_body_wrapper').slideToggle().toggleClass('hide-menu');
        }
	});

$(window).resize(function(){
  var winWidth = $(window).width();
  if(winWidth>1023){
    $('.top-menu-toggle_body_wrapper').remove('style');
    $('.top-menu-toggle_bar_wrapper').removeClass('close');
  }
});
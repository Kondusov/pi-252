// Slider
jQuery(document).ready(function ($) {

    if (typeof $.fn.owlCarousel !== 'function') {
        console.warn('Owl Carousel not found.');
        return;
    }

    // Slider 1
    var pizzeria_online_delivery_owl1 = $('.test .owl-carousel');
    if (pizzeria_online_delivery_owl1.length) {
        pizzeria_online_delivery_owl1.owlCarousel({
            items: 1,
            margin: 20,
            nav: false,
            dots: false,
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
        });
    }

    // Slider 2
    var pizzeria_online_delivery_owl2 = $('.our-products .owl-carousel');
    if (pizzeria_online_delivery_owl2.length) {
        pizzeria_online_delivery_owl2.owlCarousel({
            margin: 22,
            nav: false,
            autoplay: true,
            lazyLoad: true,
            autoplayTimeout: 3000,
            loop: true,
            dots: false,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 3 }
            },
            autoplayHoverPause: true,
            mouseDrag: true
        });
    }

	$('.mobile-nav .toggle-button').on( 'click', function() {
		$('.mobile-nav .main-navigation').slideToggle();
	});

	$('.mobile-nav-wrap .close ').on( 'click', function() {
		$('.mobile-nav .main-navigation').slideToggle();

	});

	$('<button class="submenu-toggle"></button>').insertAfter($('.mobile-nav ul .menu-item-has-children > a, .mobile-nav ul .page_item_has_children > a'));
	$('.mobile-nav ul li .submenu-toggle').on( 'click', function() {
		$(this).next().slideToggle();
		$(this).toggleClass('open');
	});

	//accessible menu for edge
	 $("#site-navigation ul li a").on( 'focus', function() {
	   $(this).parents("li").addClass("focus");
	}).on( 'blur', function() {
	    $(this).parents("li").removeClass("focus");
	 });

	//header-search
	jQuery('.search-show').click(function(){
		jQuery('.searchform-inner').css('visibility','visible');
	});

	jQuery('.close').click(function(){
		jQuery('.searchform-inner').css('visibility','hidden');
	});

});

var pizzeria_online_delivery_btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    pizzeria_online_delivery_btn.addClass('show');
  } else {
    pizzeria_online_delivery_btn.removeClass('show');
  }
});
pizzeria_online_delivery_btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

window.addEventListener('load', (event) => {
    jQuery(".preloader").delay(1000).fadeOut("slow");
});

jQuery(window).scroll(function() {
    var pizzeria_online_delivery_data_sticky = jQuery(' .head_bg').attr('data-sticky');

    if (pizzeria_online_delivery_data_sticky == 1) {
      if (jQuery(this).scrollTop() > 1){  
        jQuery('.head_bg').addClass("sticky-head");
      } else {
        jQuery('.head_bg').removeClass("sticky-head");
      }
    }
});

function pizzeria_online_delivery_preloderFunction() {
    setTimeout(function() {           
        var pageTop = document.getElementById("page-top"); 
		if (pageTop) { 
			pageTop.scrollIntoView(); 
		}
        
        $('#ctn-preloader').addClass('loaded');  
        // Once the preloader has finished, the scroll appears 
        $('body').removeClass('no-scroll-y');

        if ($('#ctn-preloader').hasClass('loaded')) {
            // It is so that once the preloader is gone, the entire preloader section will removed
            $('#preloader').delay(1000).queue(function() {
                $(this).remove();
                
                // If you want to do something after removing preloader:
                pizzeria_online_delivery_afterLoad();
                
            });
        }
    }, 3000);
}
function pizzeria_online_delivery_afterLoad() {
    // After Load function body!
}
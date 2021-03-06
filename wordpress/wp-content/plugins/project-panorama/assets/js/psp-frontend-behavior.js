jQuery(document).ready(function() { 
    
   jQuery('#main-nav a').smoothScroll(); 
   jQuery('#nav-menu a').hover(function() { 
     jQuery(this).addClass('active');  
    }, function() { 
     jQuery(this).removeClass('active'); 
    });
	
	if(jQuery('#wpadminbar').length) { 
		jQuery('#psp-title').animate({ top : "32px"},250);
	}
    
});

// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = jQuery('#psp-title').outerHeight();

jQuery(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = jQuery(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        jQuery('#psp-title').animate({ top : "-75px"},250);
        
    } else {
        // Scroll Up
        if(st + jQuery(window).height() < jQuery(document).height()) {
			if(jQuery('#wpadminbar').length) { 
				jQuery('#psp-title').animate({ top : "32px"},250);
			} else { 
				jQuery('#psp-title').animate({ top : "0px"},250);
        	}
		}
    }
    
    lastScrollTop = st;
}
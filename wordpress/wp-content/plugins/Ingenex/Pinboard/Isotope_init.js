jQuery(function($){
	$(window).load(function() {

			/* Main Function */
			function Ingenex_Isotope() {
				var $container = $('.pin-container');
				$container.imagesLoaded(function(){
					$container.isotope({
						itemSelector: '.pin-item',
						layoutMode: 'masonry',
						masonry: {
						    columnWidth: '.grid-sizer'
						}
					});
				});
			} 
			
			Ingenex_Isotope();
			
			/* Filter */
			$('.filter a').click(function(){
			  var selector = $(this).attr('data-filter');
				$('.pin-container').isotope({ filter: selector });
				$(this).parents('ul').find('a').removeClass('active');
				$(this).addClass('active');
			  return false;
			});
			
			/* Resize */
			$(window).resize(function () {
				Ingenex_Isotope();
				});

			
			/* Orientation Change */
			window.addEventListener("orientationchange", function() {
				Ingenex_Isotope();
			});
		
	});
});
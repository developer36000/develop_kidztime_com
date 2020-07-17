
(function ($) {
	"use strict";
	
	let window_location = window.location,
		hash = window_location.hash;
	

	
	$(document).ready(function() {
		let module_slider = $(document).find('.ca_pb_posts_slider_container');
		if ( module_slider.length > 0 ) {
			module_slider.each(function() {
				const _class = $(this).parents('.ca_pb_posts_slider').find('.ca_posts_blog_nav');
			
				$(this).slick({
					easing: 'linear',
					lazyLoad: 'ondemand',
					fade: false,
					autoplay: false,
					infinite: false,
					dots: false,
					arrow: true,
					draggable: true,
					speed: 300,
					variableWidth: true,
					slidesToShow: 1,
					slidesToScroll: 1,
					appendArrows: _class,
					responsive: [
						{
							breakpoint: 981,
							settings: {
								slidesToShow: 1,
								variableWidth: false,
							}
						}
					
					]
				});
				
			});
		}

		
		
	});
	
	if( $(document).find('.module_for_grid_left_side').length > 0 && $(document).find('.ca-tabs').length === 0  && $(window).width() > 981 ) {
		$(window).bind('load resize orientationChange', function () {
			let module = $(document).find('.module_for_grid_left_side');
			$('.ca_pb_posts_slider').each(function () {
				let row = module.parents('.et_pb_row'),
					row_width = row.width(),
					margin_left = (($(window).width() - row_width) / 2);
				
				$(this).css({'padding-left': margin_left});
				
			});
			
		});
	}
	
	
})(jQuery);
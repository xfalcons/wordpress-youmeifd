jQuery(document).ready(function(){
		/*
				Bg image slider
			*/
			jQuery('#mkBgSlider').superslides({
					play: 4000,
					animation: 'fade',
					pagination: false
				});
			/*
				Flex slider
			*/	
			jQuery('.flexSlider').flexslider({
					animation: "slide",
					selector: ".slides article",
					controlNav: false,
					directionNav: false,
					slideshowSpeed: 4000,
					animationSpeed : 700,
					mkBgSlider : true,
					touch: true,
					useCSS: false,
				});
				
	});			
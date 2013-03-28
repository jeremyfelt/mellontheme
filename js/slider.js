jQuery(document).ready(function($) {

//initialize the slider
	
	$('#slider-slideshow').cycle( {
		slideExpr: '.slider-post',
		speed: 300,
		timeout: 7000,
		pause: 1,
		cleartypeNoBg: true,
		pager: '#slide-thumbs',
		containerResize: false,
		slideResize: false,
		fastOnEvent: true,
		fit: false,
		fx: 'uncover',
		next: '#slider-next',
		prev: '#slider-prev',
		pagerAnchorBuilder: function( idx, slide ) { 
			return '#slide-thumbs li:eq(' + idx + ') a'; 
    	}
	});

//resize the images for the slider nav
	$('#slider-image-navbar').imagesLoaded(function() {
		var numImgs = $('img.slider-nav-thumbnail').length;
		$('div.slider-thumb-box').each(function() {
	   		var tw = $(this).parents("li").width();
	   		$(this).css("width",tw);
		});
		$('img.slider-nav-thumbnail').each(function() {
			var originalDimensions = getOriginalDimensionsOfImg(this);
	   		var tw = $(this).parents("div").width();
			var th = $(this).parents("div").height();
	   		var result = ScaleImage(originalDimensions.width, originalDimensions.height, tw, th, false);
	   		$(this).css("width",result.width);
	   		$(this).css("height",result.height);
	   		$(this).css("left", result.targetleft);
			$(this).css("top", Math.floor(result.targettop));
			$(this).css("position","absolute");
		});
	});
});
jQuery(document).ready(function($) {

	$( 'body' ).removeClass( 'no-js' );

//initialize the slider
	
	$('#featured-slideshow').cycle( {
		slideExpr: '.featured-post',
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

	//resize the images for the slider
	$('#featured-slideshow').imagesLoaded(function() {
		$('img.featured-thumbnail').each(function() {
			var originalDimensions = getOriginalDimensionsOfImg(this);
			var tw = $(this).parents("div").parents("div").width();
			var th = $(this).parents("div").parents("div").height()*1.2;
	   		var result = ScaleImage(originalDimensions.width, originalDimensions.height, tw, th, true);
	   		$(this).css("width",result.width);
	   		$(this).css("height",result.height);
	   		$(this).css("left", result.targetleft);
			$(this).css("top", Math.floor(result.targettop));
			$(this).css("position","absolute");
		});
	});
	$('#slider-nav').imagesLoaded(function() {
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
jQuery(document).ready(function($){

	$('.single_piece').mouseenter(function(){
		$(this).animate({opacity:1}, 500);
	}).mouseleave(function(){
		$(this).animate({opacity:0.5}, 500);
	});

});
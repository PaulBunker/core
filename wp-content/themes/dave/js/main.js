// js for dave
$(document).ready(function() { // dom ready

/*	=============================================================================
	Menu
	========================================================================== */
	//add accordian behaviour to the nav menu 
 
	//add speed controller for the animation
	$.extend($.ui.accordion.animations, {
		fastslide: function(options) {
			$.ui.accordion.animations.slide(options, { duration: 100 }); }
	});
	
	$('.menu').accordion({
		autoHeight: false,
		navigation: true,
		animated: 'fastslide',
		active: false,
	});
	//make top level links visit page aswell as open accordian
	$(".menu a").click(function() {
		$('#main').children().animate({opacity:0}, 200);
		window.location = $(this).attr('href');
		return;
	});

	


/*	=============================================================================
	Grid Loop
	========================================================================== */
	// Loading animation

	$(".post_excerpt_with_thumbnail").each( function(i){
		var thumb = $(this);
		thumb.css('opacity',0);
		setInterval( function(){
			thumb.animate({'opacity':1}, 1000);
		}, 200*i);
	});
  
	
	
	$('.post_excerpt_with_thumbnail').hover(function(evt){
    
		$overlay = $(this).children('h4');
    
		$overlay.hoverFlow(evt.type, {
			height:'100%'
		}, 60);
    
	},function(evt){
  
		$overlay = $(this).children('h4');

		$overlay.hoverFlow(evt.type, {
			height:'0%'
		}, 200);

	});//end hover
	
	
	
});

	


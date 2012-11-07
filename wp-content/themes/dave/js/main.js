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
  
	$(".post_excerpt_with_thumbnail").mouseenter( function(){
		$(".post_excerpt_with_thumbnail").children('h4').hide();
		clearTimeout($(this).data('timeoutId'));
		$(this).children('h4').css({opacity:0.78, 
									visibility:'visible', 
									'border-top-width':"1px",
									'border-top-style': "solid",
									'border-bottom-style':"solid",
									'border-bottom-width': "1px"}).show("blind", 60);		
	}).mouseleave(function(){
		var someElement = this;
		var timeoutId = setTimeout(function(){
			$(someElement).children('h4').stop(true, true).fadeOut(100);
    	}, 650);
		//set the timeoutId, allowing us to clear this trigger if the mouse comes back over
		$(this).data('timeoutId', timeoutId); 
		//$(this).children('h4').stop().fadeOut(200);
	});
	$(".post_excerpt_with_thumbnail").click( function(){
		$('.entry-content').children().animate({opacity:0}, 200);
	});

});

	


// end dom.ready
// EOF
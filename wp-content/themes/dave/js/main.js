// js for dave
$(document).ready(function() { // dom ready

//add accordian behaviour to the nav menu 

 
	//add speed controller for the animation
	$.extend($.ui.accordion.animations, {
		fastslide: function(options) {
			$.ui.accordion.animations.slide(options, { duration: 100 }); }
	});
	
	$('.menu').accordion({
		autoHeight: false,
		navigation: true,
		animated: 'fastslide'
	});
	//make top level links visit page aswell as open accordian
	$(".menu a").click(function() {
		window.location = $(this).attr('href');
		return;
	});

	
//sticky nav

	var stickyTop = $('.daveWell').offset().top -20; // returns number
	
	$(window).scroll(function(){ // scroll event
	
    	var windowTop = $(window).scrollTop(); // returns number
		
		if (stickyTop < windowTop) {
      		$('.daveWell').css({ position: 'fixed', top: 0 });
    	} else {
      		$('.daveWell').css('position','static');
    	}
	
	}); // end scroll event

	$(".post_excerpt_with_thumbnail").mouseenter( function(){
		$(".post_excerpt_with_thumbnail").children('h4').hide();
		clearTimeout($(this).data('timeoutId'));
		$(this).children('h4').css({opacity:0.78, 
									visibility:'visible', 
									'border-top':"1px #FFF solid",
									'border-bottom':"#DDD solid 1px"}).show("blind", 60);		
	}).mouseleave(function(){
		var someElement = this;
		var timeoutId = setTimeout(function(){
			$(someElement).children('h4').stop(true, true).fadeOut(100);
    	}, 650);
		//set the timeoutId, allowing us to clear this trigger if the mouse comes back over
		$(this).data('timeoutId', timeoutId); 
		//$(this).children('h4').stop().fadeOut(200);
	});

});

	


 // end dom.ready
// EOF
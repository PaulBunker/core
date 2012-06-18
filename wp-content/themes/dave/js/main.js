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

	 
}); // end dom.ready
// EOF
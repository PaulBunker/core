// js for dave
$(document).ready(function() { // dom ready

//add accordian behaviour to the nav menu

 
	
	$.extend($.ui.accordion.animations, {
		fastslide: function(options) {
			$.ui.accordion.animations.slide(options, { duration: 100 }); }
	});
	
	$('.menu').accordion({
		//event: "mouseover",
		navigation: true,
		animated: 'fastslide'
	});
	
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
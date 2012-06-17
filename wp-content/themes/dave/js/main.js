// js for dave
$(document).ready(function() { // dom ready

//add accordian behaviour to the nav menu

 
	//add speed controller for the animation
	$.extend($.ui.accordion.animations, {
		fastslide: function(options) {
			$.ui.accordion.animations.slide(options, { duration: 100 }); }
	});
	
	$('.menu').accordion({
		//event: "mouseover",
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

	$(".post_excerpt_with_thumbnail").hover( function(){
		$(this).children('h4').css({opacity:0.78, 
									visibility:'visible', 
									'border-top':"1px #FFF solid",
									'border-bottom':"#DDD solid 1px"}).show("blind", 60);		
	}, function(){
		$(this).children('h4').hide("blind", 60);
	});
});

	


 // end dom.ready
// EOF
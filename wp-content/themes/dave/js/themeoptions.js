jQuery(document).ready(function($) {


var genColourPicker = function( x ){
	// hide the placeholder div
	$('#'+x+'_colourpicker').hide();
	// generate farbtastic colour picker
	$('#'+x+'_colourpicker').farbtastic('#'+x);
	// show the colour picker when it's associated input field is clicked
   	$('#'+x).click(function() {
   	    $('#'+x+'_colourpicker').fadeIn();
   	});
   	$(document).mousedown(function() {
		$('#'+x+'_colourpicker').each(function() {
   	        var display = $(this).css('display');
   	        if ( display == 'block' )
   	            $(this).fadeOut();
   	    });
   	});
}

l = [ "bgcolour", "border", "border2", "defaultgridbg", "textcolour", "linkcolour" ];
for ( var x in l ){	genColourPicker( l[x] ); }


});


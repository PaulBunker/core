jQuery(document).ready(function($) {

	// hide the placeholder div
    $('#background_colourpicker').hide();
	$('#border_colourpicker').hide();
	
	// generate farbtastic colour picker
	$('#background_colourpicker').farbtastic('#background_colour');
	$('#border_colourpicker').farbtastic('#border_colour');
	
	// show the colour picker when it's associated input field is clicked
    $('#background_colour').click(function() {
        $('#background_colourpicker').fadeIn();
    });
    $('#border_colour').click(function() {
        $('#border_colourpicker').fadeIn();
    });
	
    $(document).mousedown(function() {
		$('#background_colourpicker').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).fadeOut();
        });
		$('#border_colourpicker').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).fadeOut();
        });
    });
});


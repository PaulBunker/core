<?php /* Start loop */
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//$postID = "the_ID()";

$count = 0;


while (have_posts()) : the_post();
	$count += 1;
endwhile; /* End loop */

gridLoop($count);
?>
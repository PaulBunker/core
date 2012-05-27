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

$nPerCol = $count / 3;
$n = 0;
while (have_posts()) : the_post();
	if ($n == 0){
		echo "<div class=\"span3\">";
	}
	else if ($n == ceil($nPerCol)){
		echo "<div class=\"span3\">";
	}
	else if ($n == ceil($nPerCol * 2)){
		echo "<div class=\"span3\">";
	}
	roots_post_before();
	roots_post_inside_before();
	shwizzle_excerpt_before(); ?>
		<div class="excerpt-header">
			<h4><?php
					shwizzle_open_link(get_permalink()); 
						the_title(); 
					shwizzle_close_link();
				?>
			</h4>
		</div>
		<?php
			shwizzle_open_link(get_permalink());
				showFeaturedImage( get_the_ID() );
			shwizzle_close_link(); 
			the_excerpt();
			wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>'));
		?>
	<?php 
	shwizzle_close_div();
	if ($n == ceil($nPerCol)-1){
		shwizzle_close_div();
	}
	else if ($n == ceil($nPerCol*2)-1){
		shwizzle_close_div();
	}
	else if ($n == $count){
		shwizzle_close_div();
	}
	roots_post_inside_after();
	roots_post_after();
	$n += 1; ?>
<?php endwhile; /* End loop */ ?>
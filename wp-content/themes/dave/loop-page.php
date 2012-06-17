<?php /* Start loop */
	echo "\n\n\t\t<!--loop-page.php-->\n";
//function custom_excerpt_length( $length ) {
//	return 20;
//}
//add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//$postID = "the_ID()";

$count = 0;


while (have_posts()) : the_post();
	$count += 1;
endwhile; /* End loop */

//$query = new WP_Query( 'category_name=$current_cat' );


echo $_GET["cat"];

if (is_category()){
 gridLoop();
}else{
	while (have_posts()) : the_post();
	roots_post_before();
	roots_post_inside_before(); ?>
	
	<div class="page-header">
	  	<h1><?php the_title(); ?></h1>
	</div>
	
	<?php 
	the_content();
	roots_post_inside_after();
	roots_post_after();
	endwhile;
}
?>
	
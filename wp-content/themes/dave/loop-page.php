<?php /* Start loop */

echo "\n<!--loop-page.php-->\n";

$count = 0;

while (have_posts()) : the_post();
	$count += 1;
endwhile; /* End loop */

//$query = new WP_Query( 'category_name=$current_cat' );



	while (have_posts()) : the_post();
?>
	<div class="page-header">
	  	<h1><?php the_title(); ?></h1>
	</div>
	
<?php 
	the_content();
	endwhile;

?>
	
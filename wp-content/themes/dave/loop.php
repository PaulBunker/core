<?php /* If there are no posts to display, such as an empty archive page */

echo "\n<!--loop.php-->\n";

if (!have_posts()) { ?>
  <div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">&times;</a>
    <p><?php _e('Sorry, no results were found.', 'roots'); ?></p>
  </div>
  <?php get_search_form(); ?>
<?php } ?>



<?php /* Start loop */
//function custom_excerpt_length( $length ) {
//	return 20;
//}
//add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//$postID = "the_ID()";


gridLoop();// echo get_query_var('category_name');



?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ($wp_query->max_num_pages > 1) { ?>
  <nav id="post-nav" class="pager">
    <div class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></div>
    <div class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></div>
  </nav>
<?php } ?>
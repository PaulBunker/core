<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) { ?>
  <div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">&times;</a>
    <p><?php _e('Sorry, no results were found.', 'roots'); ?></p>
  </div>
  <?php get_search_form(); ?>
<?php } ?>


<!--?php /* Start loop */ ?>
?php while (have_posts()) : the_post(); ?>
  ?php roots_post_before(); ?>
    <article id="post-?php the_ID(); ?>" ?php post_class(); ?>>
    ?php roots_post_inside_before(); ?>
      <header>
        <h2><a href="?php the_permalink(); ?>">?php the_title(); ?></a></h2>
        ?php roots_entry_meta(); ?>
      </header>
      <div class="entry-content">
        ?php if (is_archive() || is_search()) { ?>
          ?php the_excerpt(); ?>
        ?php } else { ?>
          ?php the_content(); ?>
        ?php } ?>
      </div>
      <footer>
        ?php $tags = get_the_tags(); if ($tags) { ?><p>?php the_tags(); ?></p>?php } ?>
      </footer>
    ?php roots_post_inside_after(); ?>
    </article>
  ?php roots_post_after(); ?>
?php endwhile; /* End loop */ ?-->

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

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ($wp_query->max_num_pages > 1) { ?>
  <nav id="post-nav" class="pager">
    <div class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></div>
    <div class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></div>
  </nav>
<?php } ?>
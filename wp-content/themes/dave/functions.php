<?php
/**
 * Roots functions
 */

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

require_once locate_template('/inc/util.php');            // Utility functions
require_once locate_template('/inc/config.php');          // Configuration and constants
require_once locate_template('/inc/activation.php');      // Theme activation
require_once locate_template('/inc/template-tags.php');   // Template tags
require_once locate_template('/inc/cleanup.php');         // Cleanup
require_once locate_template('/inc/scripts.php');         // Scripts and stylesheets
require_once locate_template('/inc/htaccess.php');        // Rewrites for assets, H5BP .htaccess
require_once locate_template('/inc/hooks.php');           // Hooks
require_once locate_template('/inc/actions.php');         // Actions
require_once locate_template('/inc/widgets.php');         // Sidebars and widgets
require_once locate_template('/inc/custom.php');          // Custom functions

function roots_setup() {

  // Make theme available for translation
  load_theme_textdomain('roots', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'roots'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  // add_image_size('category-thumb', 300, 9999); // 300px wide (and unlimited height)

  // Add post formats (http://codex.wordpress.org/Post_Formats)
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('css/editor-style.css');

}

add_action('after_setup_theme', 'roots_setup');


function showFeaturedImage ( $postID )
{					
	$args = array(
	'numberposts' => 1,
	'order'=> 'ASC',
	'post_mime_type' => 'image',
	'post_parent' => $postID,
	'post_status' => null,
	'post_type' => 'attachment'
	);
	
	$attachments = get_children( $args );
	
	//print_r($attachments);
	$image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post_id ), 'thumbnail' );
	echo "\t<img src=\"".$image[0]."\" class=\"frontPageThumbnail\">\n";
	//if ($attachments) {
	//	foreach($attachments as $attachment) {
	//		$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' )  ? wp_get_attachment_image_src( $attachment->ID, 'thumbnail' ) : wp_get_attachment_image_src( $attachment->ID, 'full' );
				
			//echo '<img src="'.wp_get_attachment_thumb_url( $attachment->ID ).'" class="current">';
			
	//	}
	//}
}


function gridLoop( $count, $ID ){
$nPerCol = $count / 3;
$n = 0;
while (have_posts()) : the_post();
	if ($n == 0){
		echo "<div id='col1' class=\"ecol\">";
	}
	else if ($n == ceil($nPerCol)){
		echo "<div id='col2'  class=\"ecol\">";
	}
	else if ($n == ceil($nPerCol * 2)){
		echo "<div id='col3'  class=\"ecol\">";
	}
	roots_post_before();
	roots_post_inside_before();
	shwizzle_excerpt_before(); 
		echo "\t<div class=\"excerpt-header\">
			<h4>";
				//if (is_category()) $current_cat = get_query_var('category_name');
					$current_cat = get_query_var('category_name');

					shwizzle_open_link(get_permalink(), $current_cat); 
						the_title(); 
					shwizzle_close_link();
			echo "\t\t</h4>
		</div>";
			shwizzle_open_link(get_permalink(), $current_cat);
				showFeaturedImage( get_the_ID() );
			shwizzle_close_link(); 
			the_excerpt();
			wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>'));
			
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
	$n += 1; 
 endwhile; /* End loop */	
}
?>

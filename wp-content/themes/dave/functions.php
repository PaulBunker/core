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

// Load up our awesome theme options
require_once ( get_template_directory() . '/themeoptions.php' );


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
	
//	print_r($attachments);
	$image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post_id ), 'thumbnail' );
	if(!$image)
		return false;
	else
		return "\t\t\t<img src=\"".$image[0]."\" class=\"frontPageThumbnail\" width=\"100%\">\n";
	//if ($attachments) {
	//	foreach($attachments as $attachment) {
	//		$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' )  ? wp_get_attachment_image_src( $attachment->ID, 'thumbnail' ) : wp_get_attachment_image_src( $attachment->ID, 'full' );
				
			//echo '<img src="'.wp_get_attachment_thumb_url( $attachment->ID ).'" class="current">';
			
	//	}
	//}

}


function gridLoop( ){
foreach((get_the_category()) as $category){
	$current_cat_slug = $category->slug;
}
if ( $current_cat_slug ) query_posts( 'category_name='.$current_cat_slug );
$current_cat_slug = get_query_var( 'category_name' );

// These can come from variables in a theme options script

$options = get_option('dave_theme_options');

$numColumns = $options['numcols'];
$margin = $options['marginwidth'];

// This should come from the config page which should in turn be variable according to the theme options page
$mainClassesWidth = 700;

// Find the width of our columns using number of cols and variable padding
$colWidth=floor(($mainClassesWidth-($numColumns-1)*$margin)/$numColumns);

// loop through our columns
for ($n=0; $n<$numColumns; $n++){
	$post_num = 0;
	
	// start column div and give padding to left side columns
	for($i=0; $i<$numColumns; $i++){
		if ($n==$i){
			if ($i<$numColumns-1)
				echo "<div class=\"postColumn\" style=\"width:".$colWidth."px; margin-right:".$margin."px;  margin-top:".$margin."px;\">";
			else
				echo "<div class=\"postColumn\" style=\"width:".$colWidth."px; margin-top:".$margin."px;\">";
		}
	}
	while ( have_posts() ) : the_post();
		if ($post_num % $numColumns == $n){		// only operate on posts in this column
			roots_post_before();
			roots_post_inside_before();
			shwizzle_open_link(get_permalink());
			shwizzle_excerpt_before( $margin );
			$image = showFeaturedImage( get_the_ID() );
			if (!$image){
				echo "\t\t\t<h3>";
							the_title(); 
				echo "</h3>\n";
			}else{
				echo "\t\t\t<h4>";
							the_title(); 
				echo "</h4>\n";
				echo $image;
			}
				
				//shwizzle_close_link(); 
				//the_excerpt();
				wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); // we should probably drop this
					
			shwizzle_close_div();
			shwizzle_close_link();
			roots_post_inside_after();
			roots_post_after();
			
		}
		$post_num ++; 
	 endwhile; /* End loop */	
	echo "</div>\n<!-- End Col ".($n+1)." -->\n";
}
}
?>

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

// Load up our awesome theme options
if ( file_exists( get_template_directory() . '/themeoptions2.php' ) ){
	require_once ( get_template_directory() . '/themeoptions2.php' );
}

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


function gridLoop( $defaultcat = '' ){
if(! $defaultcat == '' ){
	$current_cat_slug = $defaultcat;
}
foreach((get_the_category()) as $category){
	$current_cat_slug = $category->slug;
}
if ( $current_cat_slug ) query_posts( 'category_name='.$current_cat_slug );
$current_cat_slug = get_query_var( 'category_name' );

// These can come from variables in a theme options script

$options = get_option('dd_theme_options');

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
				echo "<div class=\"postColumn\" style=\"width:".$colWidth."px; margin-right:".$margin."px; \">";
			else
				echo "<div class=\"postColumn\" style=\"width:".$colWidth."px;\">";
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



remove_shortcode('gallery', 'gallery_shortcode');

add_shortcode('gallery', 'schwyzl_gallery_shortcode');

/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function schwyzl_gallery_shortcode($attr) {
	global $post;

	static $instance = 0;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}
	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 1,
		'size'       => 'large',
		'include'    => '',
		'exclude'    => '',
		'navheight'  => 50
	), $attr));
	
	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "    <!------------here------------>     \n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$img_desc = $image->post_excerpt;
	

	$num = 1;
	foreach ( $attachments as $id => $attachment ) {
		$thumbnail = wp_get_attachment_image_src($id, $size, true);
		$imagetitle = ($attachment->post_excerpt != '') ? $attachment->post_title." - ".$attachment->post_excerpt : $attachment->post_title ;
		$imagedescription =  $attachment->post_content;
		$output .= "\n\t\t<img class='image' src='".$thumbnail[0]."' />";
		++$num;
	}

return $output;
}



// Remove the default Thematic blogtitle function
function remove_thematic_actions() {
    remove_action('roots_head','image_constrain_size_for_editor',3);
}
// Call 'remove_thematic_actions' (above) during WP initialization
//add_action('init','remove_thematic_actions');

//add_action('roots_head', 'schwyzl_image_constrain_size_for_editor', 10, 3);

function schwyzl_image_constrain_size_for_editor($width, $height, $size = 'medium') {
	global $content_width, $_wp_additional_image_sizes;

	if ( is_array($size) ) {
		$max_width = $size[0];
		$max_height = $size[1];
	}

	elseif ( $size == 'thumb' || $size == 'thumbnail' ) {
		if(isset($thumbnail_image_width)){
			$max_width = $thumbnail_image_width;
		}else{
			$max_width = intval(get_option('thumbnail_size_w'));
		}
		if(isset($thumbnail_image_height)){
			$max_width = $thumbnail_image_height;
		}else{
			$max_height = intval(get_option('thumbnail_size_h'));
		}
		// last chance thumbnail size defaults
		if ( !$max_width && !$max_height ) {
			$max_width = 220;
			$max_height = 500;
		}
	}
	elseif ( $size == 'medium' ) {
		if(isset($medium_image_width)){
			$max_width = $medium_image_width;
		}else{
			$max_width = intval(get_option('medium_size_w'));
		}
		if(isset($medium_image_height)){
			$max_width = $medium_image_height;
		}else{
			$max_height = intval(get_option('medium_size_h'));
		}
		// if no width is set, default to the theme content width if available
	}
	elseif ( $size == 'large' ) {
		// We're inserting a large size image into the editor. If it's a really
		// big image we'll scale it down to fit reasonably within the editor
		// itself, and within the theme's content width if it's known. The user
		// can resize it in the editor if they wish.
		if(isset($large_image_width)){
			$max_width = $large_image_width;
		}else{
			$max_width = intval(get_option('large_size_w'));
		}
		if(isset($large_image_height)){
			$max_width = $large_image_height;
		}else{
			$max_height = intval(get_option('large_size_h'));
		}
		if ( intval($content_width) > 0 )
			$max_width = min( intval($content_width), $max_width );
	} elseif ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) && in_array( $size, array_keys( $_wp_additional_image_sizes ) ) ) {
		$max_width = intval( $_wp_additional_image_sizes[$size]['width'] );
		$max_height = intval( $_wp_additional_image_sizes[$size]['height'] );
		if ( intval($content_width) > 0 && is_admin() ) // Only in admin. Assume that theme authors know what they're doing.
			$max_width = min( intval($content_width), $max_width );
	}
	// $size == 'full' has no constraint
	else {
		$max_width = $width;
		$max_height = $height;
	}

	list( $max_width, $max_height ) = apply_filters( 'editor_max_image_size', array( $max_width, $max_height ), $size );

	return wp_constrain_dimensions( $width, $height, $max_width, $max_height );
}

?>

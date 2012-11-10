<?php

function roots_feed_link() {
  $count = wp_count_posts('post'); if ($count->publish > 0) {
    echo "\n\t<link rel=\"alternate\" type=\"application/rss+xml\" title=\"". get_bloginfo('name') ." Feed\" href=\"". home_url() ."/feed/\">\n";
  }
}

add_action('roots_head', 'roots_feed_link');


function themeoptions_style_func(){
	$options = get_option( 'dd_theme_options' ); 
	if( $options["css"] ){
		foreach ($options["css"] as $value){
			$css .= $value . "|";
		}
	}
	$css = urlencode($css);
	echo "\t<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"". get_template_directory_uri() . "/css/style.php?css=" . $css . "\"/>\n";
	echo "\t<link rel=\"shortcut icon\" href=\"" . $options['favicon'] . "\" />\t ";
}
add_action('themeoptions_style', 'themeoptions_style_func');


function roots_google_analytics() {
  $roots_google_analytics_id = GOOGLE_ANALYTICS_ID;
  if ($roots_google_analytics_id !== '') {
    echo "\n\t<script>\n";
    echo "\t\tvar _gaq=[['_setAccount','$roots_google_analytics_id'],['_trackPageview']];\n";
    echo "\t\t(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];\n";
    echo "\t\tg.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';\n";
    echo "\t\ts.parentNode.insertBefore(g,s)}(document,'script'));\n";
    echo "\t</script>\n";
  }
}

add_action('roots_footer', 'roots_google_analytics');


add_action('shwizzle_excerpt_before', 'shwizzle_excerpt_before_func',11, 2);
function shwizzle_excerpt_before_func( $margin, $link ){
	echo "\n\t\t<a href='".$link ."' class='post_excerpt_with_thumbnail' style='margin-bottom:".$margin."px;'>\n";
}

//add_action('shwizzle_close_div', 'shwizzle_close_div_func');
//function shwizzle_close_div_func(){
//	echo "\t\t</div>\n";
//}
//add_action('shwizzle_open_link', 'shwizzle_open_link_func',10, 2);
//function shwizzle_open_link_func($link){
//	echo "\n\t<a href='".$link;
//	echo "'>";
//}
add_action('shwizzle_close_link', 'shwizzle_close_link_func');
function shwizzle_close_link_func(){
	echo "\t</a>\n";
}

?>
<?php

// header.php
function roots_head() { do_action('roots_head'); }
function roots_wrap_before() { do_action('roots_wrap_before'); }
function roots_header_before() { do_action('roots_header_before'); }
function roots_header_inside() { do_action('roots_header_inside'); }
function roots_header_after() { do_action('roots_header_after'); }

// 404.php, archive.php, front-page.php, index.php, loop-page.php, loop-single.php,
// loop.php, page-custom.php, page-full.php, page.php, search.php, single.php
function roots_content_before() { do_action('roots_content_before'); }
function roots_content_after() { do_action('roots_content_after'); }
function roots_main_before() { do_action('roots_main_before'); }
function roots_main_after() { do_action('roots_main_after'); }
function roots_post_before() { do_action('roots_post_before'); }
function roots_post_after() { do_action('roots_post_after'); }
function roots_post_inside_before() { do_action('roots_post_inside_before'); }
function roots_post_inside_after() { do_action('roots_post_inside_after'); }
function roots_loop_before() { do_action('roots_loop_before'); }
function roots_loop_after() { do_action('roots_loop_after'); }
function roots_sidebar_before() { do_action('roots_sidebar_before'); }
function roots_sidebar_inside_before() { do_action('roots_sidebar_inside_before'); }
function roots_sidebar_inside_after() { do_action('roots_sidebar_inside_after'); }
function roots_sidebar_after() { do_action('roots_sidebar_after'); }

// footer.php
function roots_footer_before() { do_action('roots_footer_before'); }
function roots_footer_inside() { do_action('roots_footer_inside'); }
function roots_footer_after() { do_action('roots_footer_after'); }
function roots_footer() { do_action('roots_footer'); }

// shwizzle
function shwizzle_excerpt_before($margin) { do_action('shwizzle_excerpt_before', $margin); }
function shwizzle_close_div() { do_action('shwizzle_close_div'); }
function shwizzle_open_link($link) { do_action('shwizzle_open_link', $link); }
function shwizzle_close_link() { do_action('shwizzle_close_link'); }

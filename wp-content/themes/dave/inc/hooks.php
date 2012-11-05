<?php

// header.php
function themeoptions_style() { do_action('themeoptions_style'); }

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

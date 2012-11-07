<?php
/*
Template Name: Front page
*/
get_header(); ?>
		<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
				<aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
					<?php get_sidebar(); ?>
				</aside><!-- /#sidebar -->
				<div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
						<?php 
							gridLoop(mytheme_option('defaultcat'));
						?>
				</div><!-- /#main -->
		</div><!-- /#content -->
<?php get_footer(); ?>
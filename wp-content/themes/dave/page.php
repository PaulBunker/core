<?php get_header(); 
	echo "\n\n\t\t<!--page.php-->\n";
?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> page">
      <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        <?php get_sidebar(); ?>
      </aside><!-- /#sidebar -->
      <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
        <?php get_template_part('loop', 'page'); ?>
      </div><!-- /#main -->
    </div><!-- /#content -->
<?php get_footer(); ?>
<?php get_header(); ?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
      <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        <?php get_sidebar(); ?>
      </aside><!-- /#sidebar -->
      <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
        <?php get_template_part('loop', 'single'); ?>
        <?php get_template_part('loop', 'category'); ?>
      </div><!-- /#main -->
    </div><!-- /#content -->
<?php get_footer(); ?>
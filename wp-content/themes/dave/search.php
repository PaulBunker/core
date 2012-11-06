<?php get_header(); ?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
      <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        <?php get_sidebar(); ?>
      </aside><!-- /#sidebar -->
      <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
        <div class="page-header">
          <h4><?php _e('Search Results for ', 'roots'); ?>"<?php echo get_search_query(); ?>"</h1>
        </div>
        <?php get_template_part('loop', 'search'); ?>
      </div><!-- /#main -->
    </div><!-- /#content -->
<?php get_footer(); ?>
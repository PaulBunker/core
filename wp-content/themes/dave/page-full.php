<?php
/*
Template Name: Full Width
*/
get_header(); ?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
      <div id="main" class="<?php echo FULLWIDTH_CLASSES; ?>" role="main">
        <?php get_template_part('loop', 'page'); ?>
      </div><!-- /#main -->
    </div><!-- /#content -->
<?php get_footer(); ?>
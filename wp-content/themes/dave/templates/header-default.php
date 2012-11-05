<header id="banner" role="banner">

<?php 

$options = get_option('dd_theme_options');
$headerimage = '';
$headerimage = $options['headerimage'];
if ($headerimage != ''){
$headertextclass = 'hiddenleft';	
}else{
$headertextclass = '';
}?>
<div class="<?php echo WRAP_CLASSES; ?>">
    <a class="brand <?php echo HEADER_CLASSES; ?>" href="<?php echo home_url(); ?>/" style="background:url('<?php echo $options['headerimage']; ?>');">
      <span class='name <?php echo $headertextclass ?>'><?php bloginfo('name'); ?></span><br />
      <span class='description <?php echo $headertextclass ?>'><?php bloginfo('description'); ?></span>
    </a>
  </div>
</header>
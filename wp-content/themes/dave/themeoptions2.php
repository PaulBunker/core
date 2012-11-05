<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );
/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'dave_options', 'dave_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	$page = add_theme_page( __( 'Theme Options', 'davetheme' ), __( 'Theme Options', 'davetheme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
	add_action( 'admin_print_styles-' . $page, 'dave_options_scripts' );
}

/**
 * Load jquery and the color picker widget
 */
function dave_options_scripts() {
    wp_enqueue_style( 'farbtastic' );
    wp_enqueue_script( 'farbtastic' );
    wp_enqueue_script( 'dave_options', get_template_directory_uri() . '/js/themeoptions.js', array( 'farbtastic', 'jquery' ) );
}
/**
 * Create arrays for our select and radio options
 */
$column_options = array();
$colv=2;
for($colv; $colv<=7; $colv++){
	$column_options[$colv] = array(
			'value' =>	$colv,
			'label' => __( $colv, 'davetheme' )
	);
}

$margin_options = array();
$marginv=2;
for($marginv; $marginv<=20; $marginv++){
	$margin_options[$marginv] = array(
			'value' =>	$marginv,
			'label' => __( $marginv, 'davetheme' )
	);
}
	
$colour_options = array(
	'light' => array(
		'value' => 'light',
		'label' => __( 'Light', 'davetheme' )
	),
	'dark' => array(
		'value' => 'dark',
		'label' => __( 'Dark', 'davetheme' )
	)
);

$catargs = array(
	'orderby'       => 'name',
	'hide_empty'    => 1,
	'hierarchical'  => 0,
	'parent'        => 0
);
$category_options = get_categories( $catargs );

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $column_options, $margin_options, $colour_options, $category_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'davetheme' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'davetheme' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'dave_options' ); ?>
			<?php $options = get_option( 'dave_theme_options' ); ?>

			<table class="form-table">
				<?php
				/**
				 * A color picker option // background colur
				 		TOM: input id's with []'s messed with the jquery,
							couldn't use --->	 <input id="dave_theme_options[color....
							for testing ---->	 <input id="color"
								will change for more appropriate names eg. dave_theme_options_backgroundColour
								consider change all id's to this format
						PAUL: agreed, the current formar is residual only  
				 */
				?>
                <tr valign="top"><th scope="row"><?php _e( 'Background Colour', 'davetheme' ); ?></th>
					<td>
                        <input	id="background_colour" 
								name="dave_theme_options[css][backgroundcolour]" 
								type="text" 
								value="<?php $v=(esc_attr($options['css']['backgroundcolour'])=='')?'#FFF':esc_attr( $options['css']['backgroundcolour'] ); echo $v; ?>" />
						<label class="description" for="dave_theme_options[css][backgroundcolour]"><?php _e( 'Select a colour using the colour picker', 'davetheme' ); ?></label>
                        <div style="position: absolute;" id="background_colourpicker"></div>
					</td>
				</tr>
				<?php
				/**
				 * A color picker option // border colour
				 */
				?>
                <tr valign="top"><th scope="row"><?php _e( 'Border Colour', 'davetheme' ); ?></th>
					<td>
                        <input	id="border_colour" 
								name="dave_theme_options[css][bordercolour]" 
								type="text" 
								value="<?php $v=(esc_attr($options['css']['bordercolour'])=='')?'#000':esc_attr( $options['css']['bordercolour'] ); echo $v;?>" />
						<label class="description" for="dave_theme_options[css][bordercolour]"><?php _e( 'Select a colour using the colour picker', 'davetheme' ); ?></label>
                        <div style="position: absolute;" id="border_colourpicker"></div>
					</td>
				</tr>
				<?php
				/**
				 * Colour options radio buttons
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Text Colour Options', 'davetheme' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Text Colour Options', 'davetheme' ); ?></span></legend>
							<?php
								if ( ! isset( $checked ) )
									$checked = '';
								foreach ( $colour_options as $option ) {
									$radio_setting = $options['colouroptions'];
									if ( '' != $radio_setting ) {
										if ( $options['colouroptions'] == $option['value'] ) {
											$checked = "checked=\"checked\"";
										} else {
											$checked = '';
										}
									}
								?>
								<label class="description">
									<input type="radio" name="dave_theme_options[colouroptions]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?>
								</label><br />
							<?php
							}
							?>
						</fieldset>
					</td>
				</tr>
				<?php
				/**
				 * A select input option // number of columns
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Number of columns', 'davetheme' ); ?></th>
					<td>
						<select name="dave_theme_options[numcols]">
							<?php
								$selected = $options['numcols'];
								$p = '';
								$r = '';

								foreach ( $column_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="dave_theme_options[numcols]"><?php _e( 'Select number of columns in the grid', 'davetheme' ); ?></label>
					</td>
				</tr>
				<?php
				/**
				 * A dave select input option // margin width
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Margin width', 'davetheme' ); ?></th>
					<td>
						<select name="dave_theme_options[marginwidth]">
							<?php
								$selected = $options['marginwidth'];
								$p = '';
								$r = '';

								foreach ( $margin_options as $option ) {
									$label = $option['label'];
									$value = $option['value'];
									if ( $selected == $value ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $value ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $value ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="dave_theme_options[marginwidth]"><?php _e( 'Select the margin width', 'davetheme' ); ?></label>
					</td>
				</tr>
				<?php
				/**
				 * Default category picker (for home page)
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Default category', 'davetheme' ); ?></th>
					<td>
						<select name="dave_theme_options[defaultcat]">
							<?php
								$selected = $options['defaultcat'];
								$p = '';
								$r = '';
								foreach( $category_options as $category ){ 
									$label = $category->name;
									$value = $category->slug;
									if ( $selected == $value ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $value ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $value ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="dave_theme_options[defaultcat]"><?php _e( 'Choose default category', 'davetheme' ); ?></label>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'davetheme' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}


/**
 * Validate hex string
 */
function validate_hex( $colour, $default ){
	
	//Check for a hex color string '#c1c2b4'
	if(preg_match('/^#[a-f0-9]{6}$/i', $colour)) //hex color is valid
	{
	      //Verified hex color
	} 
	//Check for a hex color string without hash 'c1c2b4'
	else if(preg_match('/^[a-f0-9]{6}$/i', $colour)) //hex color is valid
	{
		$colour = '#' . $colour;
	}
	else {
		$colour = $default;
	}
	return $colour;
}


/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $column_options, $margin_options, $colour_options, $category_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['marginwidth'], $margin_options ) )
		$input['marginwidth'] = 20;
	if ( ! array_key_exists( $input['numcols'], $column_options ) )
		$input['numcols'] = 3;					

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );
	
	$input['backgroundcolour'] = validate_hex($input['backgroundcolour'], '#FFFFFF');
	$input['bordercolour'] = validate_hex($input['bordercolour'], '#000000');
	//$input['bordercolour'] = $input['bordercolour'];
	
	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/

?>

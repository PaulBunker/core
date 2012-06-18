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
	add_theme_page( __( 'Theme Options', 'davetheme' ), __( 'Theme Options', 'davetheme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create arrays for our select and radio options
 */
$select_options = array(
	'0' => array(
		'value' =>	'0',
		'label' => __( 'Zero', 'davetheme' )
	),
	'1' => array(
		'value' =>	'1',
		'label' => __( 'One', 'davetheme' )
	),
	'2' => array(
		'value' => '2',
		'label' => __( 'Two', 'davetheme' )
	),
	'3' => array(
		'value' => '3',
		'label' => __( 'Three', 'davetheme' )
	),
	'4' => array(
		'value' => '4',
		'label' => __( 'Four', 'davetheme' )
	),
	'5' => array(
		'value' => '5',
		'label' => __( 'Five', 'davetheme' )
	)
);

$margin_options = array(
	'2' => array(
		'value' =>	'2',
		'label' => __( '2', 'davetheme' )
	),
	'3' => array(
		'value' =>	'3',
		'label' => __( '3', 'davetheme' )
	),
	'4' => array(
		'value' => '5',
		'label' => __( '4', 'davetheme' )
	),
	'5' => array(
		'value' => '5',
		'label' => __( '5', 'davetheme' )
	),
	'6' => array(
		'value' => '6',
		'label' => __( '6', 'davetheme' )
	),
	'7' => array(
		'value' => '7',
		'label' => __( '7', 'davetheme' )
	),
	'8' => array(
		'value' => '8',
		'label' => __( '8', 'davetheme' )
	),
	'9' => array(
		'value' => '9',
		'label' => __( '9', 'davetheme' )
	),
	'10' => array(
		'value' => '10',
		'label' => __( '10', 'davetheme' )
	),
	'11' => array(
		'value' => '11',
		'label' => __( '11', 'davetheme' )
	),
	'12' => array(
		'value' => '12',
		'label' => __( '12', 'davetheme' )
	),
	'13' => array(
		'value' => '13',
		'label' => __( '13', 'davetheme' )
	),
	'14' => array(
		'value' => '14',
		'label' => __( '14', 'davetheme' )
	),
	'15' => array(
		'value' => '15',
		'label' => __( '15', 'davetheme' )
	),
	'16' => array(
		'value' => '16',
		'label' => __( '16', 'davetheme' )
	),
	'17' => array(
		'value' => '17',
		'label' => __( '17', 'davetheme' )
	),
	'18' => array(
		'value' => '18',
		'label' => __( '18', 'davetheme' )
	),
	'19' => array(
		'value' => '19',
		'label' => __( '19', 'davetheme' )
	),
	'20' => array(
		'value' => '20',
		'label' => __( '20', 'davetheme' )
	)
);

$radio_options = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __( 'Yes', 'davetheme' )
	),
	'no' => array(
		'value' => 'no',
		'label' => __( 'No', 'davetheme' )
	),
	'maybe' => array(
		'value' => 'maybe',
		'label' => __( 'Maybe', 'davetheme' )
	)
);

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $margin_options, $radio_options;

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
				 * A dave checkbox option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'A checkbox', 'davetheme' ); ?></th>
					<td>
						<input id="dave_theme_options[option1]" name="dave_theme_options[option1]" type="checkbox" value="1" <?php checked( '1', $options['option1'] ); ?> />
						<label class="description" for="dave_theme_options[option1]"><?php _e( 'Sample checkbox', 'davetheme' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * A dave text input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Margin', 'davetheme' ); ?></th>
					<td>
						<input id="dave_theme_options[sometext]" class="regular-text" type="text" name="dave_theme_options[sometext]" value="<?php esc_attr_e( $options['sometext'] ); ?>" />
						<label class="description" for="dave_theme_options[sometext]"><?php _e( 'Margin width', 'davetheme' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * A dave select input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Number of columns', 'davetheme' ); ?></th>
					<td>
						<select name="dave_theme_options[selectinput]">
							<?php
								$selected = $options['selectinput'];
								$p = '';
								$r = '';

								foreach ( $select_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="dave_theme_options[selectinput]"><?php _e( 'Select number of columns in the grid', 'davetheme' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * A dave select input option
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
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="dave_theme_options[marginwidth]"><?php _e( 'Select the margin width', 'davetheme' ); ?></label>
					</td>
				</tr>
				<?php
				/**
				 * A dave of radio buttons
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Radio buttons', 'davetheme' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Radio buttons', 'davetheme' ); ?></span></legend>
						<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( $radio_options as $option ) {
								$radio_setting = $options['radioinput'];

								if ( '' != $radio_setting ) {
									if ( $options['radioinput'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
								<label class="description"><input type="radio" name="dave_theme_options[radioinput]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<?php
				/**
				 * A dave textarea option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'A textbox', 'davetheme' ); ?></th>
					<td>
						<textarea id="dave_theme_options[sometextarea]" class="large-text" cols="50" rows="10" name="dave_theme_options[sometextarea]"><?php echo esc_textarea( $options['sometextarea'] ); ?></textarea>
						<label class="description" for="dave_theme_options[sometextarea]"><?php _e( 'Sample text box', 'davetheme' ); ?></label>
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
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
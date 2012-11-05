<?php

/**
 * Master theme class
 * 
 */
class My_Theme_Options {
	
	private $sections;
	private $checkboxes;
	private $settings;
	
	/**
	 * Construct
	 *
	 */
	public function __construct() {
		
		// This will keep track of the checkbox options for the validate_settings function.
		$this->checkboxes = array();
		$this->colours = array();
		$this->settings = array();
		$this->get_settings();
		
		$this->sections['general']		= __( 'General Settings' );
		$this->sections['colour']		= __( 'Colours' );
		$this->sections['reset']		= __( 'Reset to Defaults' );
		$this->sections['about']		= __( 'About' );
				
		add_action( 'admin_menu', array( &$this, 'add_pages' ) );
		add_action( 'admin_init', array( &$this, 'register_settings' ) );		
		
		if ( ! get_option( 'dd_theme_options' ) )
			$this->initialize_settings();
		
	}
	
	/**
	 * Add options page
	 *
	 */
	public function add_pages() {
		
		$admin_page = add_theme_page( __( 'Theme Options' ), __( 'Theme Options' ), 'manage_options', 'mytheme-options', array( &$this, 'display_page' ) );
		
		
		add_action( 'admin_print_scripts-' . $admin_page, array( &$this, 'scripts' ) );
		add_action( 'admin_print_styles-' . $admin_page, array( &$this, 'styles' ) );
		
	}
	
	/**
	 * Create settings field
	 *
	 */
	public function create_setting( $args = array() ) {
		
		$defaults = array(
			'id'      => 'default_field',
			'title'   => __( 'Default Field' ),
			'desc'    => __( 'This is a default description.' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'layout',
			'choices' => array(),
			'class'   => '',
			'css'	  => true
		);
			
		extract( wp_parse_args( $args, $defaults ) );
		
		$field_args = array(
			'type'      => $type,
			'id'        => $id,
			'desc'      => $desc,
			'std'       => $std,
			'choices'   => $choices,
			'label_for' => $id,
			'class'     => $class,
			'css'	    => $css
		);
		
		if ( $type == 'checkbox' )
			$this->checkboxes[] = $id;
		
		add_settings_field( $id, $title, array( $this, 'display_setting' ), 'mytheme-options', $section, $field_args );
	}
	
	/**
	 * Display options page
	 *
	 */
	public function display_page() {
		
		echo '<div class="wrap">
	<div class="icon32" id="icon-options-general"></div>
	<h2>' . __( 'Theme Options' ) . '</h2>';
	
		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true )
			echo '<div class="updated fade"><p>' . __( 'Theme options updated.' ) . '</p></div>';
		
		echo '<form action="options.php" method="post">';
	
		settings_fields( 'dd_theme_options' );
		echo '<div class="ui-tabs">
			<ul class="ui-tabs-nav">';
		
		foreach ( $this->sections as $section_slug => $section )
			echo '<li><a href="#' . $section_slug . '">' . $section . '</a></li>';
		
		echo '</ul>';
		do_settings_sections( $_GET['page'] );
		
		echo '</div>
		<p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . __( 'Save Changes' ) . '" /></p>
		
	</form>';
	
	echo '<script type="text/javascript">
		jQuery(document).ready(function($) {
			var sections = [];';
			
			foreach ( $this->sections as $section_slug => $section )
				echo "sections['$section'] = '$section_slug';";
			
			echo 'var wrapped = $(".wrap h3").wrap("<div class=\"ui-tabs-panel\">");
			wrapped.each(function() {
				$(this).parent().append($(this).parent().nextUntil("div.ui-tabs-panel"));
			});
			$(".ui-tabs-panel").each(function(index) {
				$(this).attr("id", sections[$(this).children("h3").text()]);
				if (index > 0)
					$(this).addClass("ui-tabs-hide");
			});
			$(".ui-tabs").tabs({
				fx: { opacity: "toggle", duration: "fast" }
			});
			
			$("input[type=text], textarea").each(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "")
					$(this).css("color", "#999");
			});
			
			$("input[type=text], textarea").focus(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "") {
					$(this).val("");
					$(this).css("color", "#000");
				}
			}).blur(function() {
				if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
					$(this).val($(this).attr("placeholder"));
					$(this).css("color", "#999");
				}
			});
			
			$(".wrap h3, .wrap table").show();
			
			// This will make the "warning" checkbox class really stand out when checked.
			// I use it here for the Reset checkbox.
			$(".warning").change(function() {
				if ($(this).is(":checked"))
					$(this).parent().css("background", "#c00").css("color", "#fff").css("fontWeight", "bold");
				else
					$(this).parent().css("background", "none").css("color", "inherit").css("fontWeight", "normal");
			});
			
			// Browser compatibility
			if ($.browser.mozilla) 
			         $("form").attr("autocomplete", "off");
		});
	</script>
</div>';
		
	}
	
	/**
	 * Description for section
	 *
	 */
	public function display_section() {
		// code
	}
	
	/**
	 * Description for About section
	 *
	 */
	public function display_about_section() {
		
		// This displays on the "About" tab. Echo regular HTML here, like so:
		// echo '<p>Copyright 2011 me@example.com</p>';
		
	}
	
	/**
	 * HTML output for text field
	 *
	 */
	public function display_setting( $args = array() ) {
		
		extract( $args );
		
		$options = get_option( 'dd_theme_options' );
		
		if ( ! isset( $options[$id] ) && $type != 'checkbox' )
			$options[$id] = $std;
		elseif ( ! isset( $options[$id] ) )
			$options[$id] = 0;
		
		$field_class = '';
		if ( $class != '' )
			$field_class = ' ' . $class;
				
		switch ( $type ) {
			
			case 'heading':
				echo '</td></tr><tr valign="top"><td colspan="2"><h4>' . $desc . '</h4>';
				break;
			
			case 'checkbox':
				echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="dd_theme_options[' . $id . ']" value="1" ' . checked( $options[$id], 1, false ) . ' /> <label for="' . $id . '">' . $desc . '</label>';
				break;
			
			case 'select':
				echo '<select class="select' . $field_class . '" name="dd_theme_options[' . $id . ']">';
				foreach ( $choices as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $options[$id], $value, false ) . '>' . $label . '</option>';
				
				echo '</select>';
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				break;
			
			case 'radio':
				$i = 0;
				foreach ( $choices as $value => $label ) {
					echo '<input class="radio' . $field_class . '" type="radio" name="dd_theme_options[' . $id . ']" id="' . $id . $i . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '> <label for="' . $id . $i . '">' . $label . '</label>';
					if ( $i < count( $options ) - 1 )
						echo '<br />';
					$i++;
				}
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'textarea':
				echo '<textarea class="' . $field_class . '" id="' . $id . '" name="dd_theme_options[' . $id . ']" placeholder="' . $std . '" rows="5" cols="30">' . wp_htmledit_pre( $options[$id] ) . '</textarea>';
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				break;
			
			case 'password':
				echo '<input class="regular-text' . $field_class . '" type="password" id="' . $id . '" name="dd_theme_options[' . $id . ']" value="' . esc_attr( $options[$id] ) . '" />';
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				break;
			
			case 'text':
		 		echo '<input class="regular-text' . $field_class . '" type="text" id="' . $id . '" name="dd_theme_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';
		 		if ( $desc != '' )
		 			echo '<br /><span class="description">' . $desc . '</span>';
		 		break;
				
			case 'colour':
				echo '<input	id="'. $id . '"';
				echo ' name="dd_theme_options';
					if ( $css ){echo '[css]';} echo '[' . $id . ']"';
				echo ' type="text"';
				echo ' value="'; $v=( $css )? esc_attr( $options[ 'css' ][ $id ] ) : esc_attr( $options[ $id ] ); echo ( $v=='' )? $std: $v ; echo '" />';
				echo '<div style="position: absolute;" id="' . $id . '_colourpicker"></div>';
		 			if ( $desc != '' )
		 				echo '<br /><span class="description">' . $desc . '</span>';	
				break;

			case 'upload':
		 		echo '<input class="upload_image' . $field_class . '" type="text" id="' . $id . '" name="dd_theme_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';
				echo '<input id="upload_image_button" class="upload_image_button" type="button" name="upload_button" value="Upload" />';
		 		if ( $desc != '' )
		 			echo '<br /><span class="description">' . $desc . '</span>';
		 		break;

			case 'info':
			default:
				echo '</td></tr><tr valign="top"><td colspan="2"><p>' . $desc . '</p>';
				break;
				
			
		}
		
	}
	
	/**
	 * Settings and defaults
	 * 
	 */
	public function get_settings() {
		
		/* General Settings
		===========================================*/
		$this->settings['layout_options'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Layout Options',
			'type'    => 'heading'
		);

		$column_options = array();
		$columnv = 2;
		for($columnv; $columnv <= 7; $columnv++){
			$column_options[$columnv] = $columnv;
		}
		$this->settings['numcols'] = array(
			'section' => 'general',
			'title'   => __( 'Number of columns' ),
			'desc'    => __( 'Choose the number of columns to display in the category grid' ),
			'type'    => 'select',
			'std'     => '3',
			'choices' => $column_options
		);
		
		$margin_options = array();
		$marginv = 2;
		for($marginv; $marginv <= 20; $marginv++){
			$margin_options[$marginv] = $marginv;
		}
		$this->settings['marginwidth'] = array(
			'section' => 'general',
			'title'   => __( 'Margin Width' ),
			'desc'    => __( 'Choose the margin width.' ),
			'type'    => 'select',
			'std'     => '20',
			'choices' => $margin_options
		);
		
		$catargs = array(
			'orderby'       => 'name',
			'hide_empty'    => 1,
			'hierarchical'  => 0,
			'parent'        => 0
		);
		$category_options = get_categories( $catargs );
		$category_choices = array();
		foreach( $category_options as $category ){ 
			$label = $category->name;
			$value = $category->slug;
			$category_choices[ $value ] = $label ;
		}
		$this->settings['defaultcat'] = array(
			'section' => 'general',
			'title'   => __( 'Default Category' ),
			'desc'    => __( 'Choose a category to display on the home page.' ),
			'type'    => 'select',
			'std'     => DEFAULT_CATEGORY,
			'choices' => $category_choices
		);		
				
	/*	$this->settings['example_text'] = array(
			'title'   => __( 'Example Text Input' ),
			'desc'    => __( 'This is a description for the text input.' ),
			'std'     => 'Default value',
			'type'    => 'text',
			'section' => 'general'
		);
		
		$this->settings['example_textarea'] = array(
			'title'   => __( 'Example Textarea Input' ),
			'desc'    => __( 'This is a description for the textarea input.' ),
			'std'     => 'Default value',
			'type'    => 'textarea',
			'section' => 'general'
		);
		
		$this->settings['example_checkbox'] = array(
			'section' => 'general',
			'title'   => __( 'Example Checkbox' ),
			'desc'    => __( 'This is a description for the checkbox.' ),
			'type'    => 'checkbox',
			'std'     => 1 // Set to 1 to be checked by default, 0 to be unchecked by default.
		);
		*/
		
		$this->settings['Header_options'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Header Options',
			'type'    => 'heading'
		);
		
		$this->settings['headerimage'] = array(
			'section' => 'general',
			'title'   => __( 'Header Image' ),
			'desc'    => __( 'Choose an image exactly 220 x 100 pixels.' ),	
			'std'     => DEFAULT_HEADER_TEXT,
			'id'	  => 'headerimage',
			'type'    => 'upload'

		);
		
		/*$this->settings['example_radio'] = array(
			'section' => 'general',
			'title'   => __( 'Example Radio' ),
			'desc'    => __( 'This is a description for the radio buttons.' ),
			'type'    => 'radio',
			'std'     => '',
			'choices' => array(
				'choice1' => 'Choice 1',
				'choice2' => 'Choice 2',
				'choice3' => 'Choice 3'
			)
		);*/
		
		/* Colour
		===========================================*/

		$this->settings['bgcolour'] = array(
			'section' => 'colour',
			'title'   => __( 'Background Colour' ),
			'desc'    => __( 'Choose a colour for the background.' ),
			'type'    => 'colour',
			'std'     => '#FFF',
			'css'	  => true
		);
	
		$this->settings['border'] = array(
			'section' => 'colour',
			'title'   => __( 'Border Colour' ),
			'desc'    => __( 'Choose a colour for the border.' ),
			'type'    => 'colour',
			'std'     => '#000',
			'css'	  => true
		);

		$this->settings['border2'] = array(
			'section' => 'colour',
			'title'   => __( 'Secondary Border Colour' ),
			'desc'    => __( 'Choose a colour for the navigation seperators.' ),
			'type'    => 'colour',
			'std'     => '#000',
			'css'	  => true
		);

		$this->settings['defaultgridbg'] = array(
			'section' => 'colour',
			'title'   => __( 'Default Grid Colour' ),
			'desc'    => __( 'Choose a default colour for posts that do not have a featured image.' ),
			'type'    => 'colour',
			'std'     => '#000',
			'css'	  => true
		);

		$this->settings['textcolour'] = array(
			'section' => 'colour',
			'title'   => __( 'Text Colour' ),
			'desc'    => __( 'Choose a colour for text.' ),
			'type'    => 'colour',
			'std'     => '#000',
			'css'	  => true
		);

		$this->settings['linkcolour'] = array(
			'section' => 'colour',
			'title'   => __( 'Link Colour' ),
			'desc'    => __( 'Choose a colour for links.' ),
			'type'    => 'colour',
			'std'     => '#057cff',
			'css'	  => true
		);
		
		$this->settings['favicon'] = array(
			'section' => 'colour',
			'title'   => __( 'Favicon' ),
			'desc'    => __( 'Enter the URL to your custom favicon. It should be 16x16 pixels in size.' ),
			'type'    => 'text',
			'std'     => DEFAULT_FAVICON
		);
		
/*		$this->settings['custom_css'] = array(
			'title'   => __( 'Custom Styles' ),
			'desc'    => __( 'Enter any custom CSS here to apply it to your theme.' ),
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'colour',
			'class'   => 'code'
		);
*/				
		/* Reset
		===========================================*/
		
		$this->settings['reset_theme'] = array(
			'section' => 'reset',
			'title'   => __( 'Reset theme' ),
			'type'    => 'checkbox',
			'std'     => 0,
			'class'   => 'warning', // Custom class for CSS
			'desc'    => __( 'Check this box and click "Save Changes" below to reset theme options to their defaults.' )
		);

		/* Reset
		===========================================*/	
			$this->settings['about'] = array(
			'section' => 'about',
			'title'   => '', // Not used for headings.
			'desc'    => __( 'This theme was developed for Dave Dalziel by Paul Bunker and Tom Schwarz 2012. </br> Not for redistribution. </br></br> tpschwarz@gmail.com </br> paulmarkbunker@gmail.com' ),
			'type'	  => 'info'
		);
		
	}
	
	/**
	 * Initialize settings to their default values
	 * 
	 */
	public function initialize_settings() {
		
		$default_settings = array();
		foreach ( $this->settings as $id => $setting ) {
			if ( $setting['type'] != 'heading' )
				if ($setting['css'] != true)
					$default_settings[$id] = $setting['std'];
				else
					$default_settings['css'][$id] = $setting['std'];
		}
		
		update_option( 'dd_theme_options', $default_settings );
		
	}
	
	/**
	* Register settings
	*
	*/
	public function register_settings() {
		
		register_setting( 'dd_theme_options', 'dd_theme_options', array ( &$this, 'validate_settings' ) );
		
		foreach ( $this->sections as $slug => $title ) {
			if ( $slug == 'about' )
				add_settings_section( $slug, $title, array( &$this, 'display_about_section' ), 'mytheme-options' );
			else
				add_settings_section( $slug, $title, array( &$this, 'display_section' ), 'mytheme-options' );
		}
		
		$this->get_settings();
		
		foreach ( $this->settings as $id => $setting ) {
			$setting['id'] = $id;
			$this->create_setting( $setting );
		}
		
	}
	
	/**
	* jQuery Tabs
	*
	*/
	public function scripts() {
		
		wp_print_scripts( 'jquery-ui-tabs' );
	    wp_print_scripts( 'farbtastic' );
		wp_register_script( 'themeoptions', get_template_directory_uri() . '/js/themeoptions.js' );
	    wp_print_scripts( 'themeoptions' );
		
		//Media Uploader Scripts
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', get_template_directory_uri() . '/js/uploader.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-upload');

	}
	
	/**
	* Styling for the theme options page
	*
	*/
	public function styles() {
		
		wp_register_style( 'mytheme-admin', get_template_directory_uri() . '/css/themeoptions.css' );
		wp_enqueue_style( 'mytheme-admin' );
	    wp_enqueue_style( 'farbtastic' );
		
		//Media Uploader Style
		wp_enqueue_style('thickbox');

		
	}
	
	/*
	 * Validate hex string
	 */
	public function validate_hex( $colour, $default ){
	
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
	
	/*
	 * Validate settings
	 */
	public function validate_settings( $input ) {
		if ( ! isset( $input['reset_theme'] ) ) {
			$options = get_option( 'dd_theme_options' );
			foreach ( $this->checkboxes as $id ) {
				if ( isset( $options[$id] ) && ! isset( $input[$id] ) )
					unset( $options[$id] );
			}
			return $input;
		}
		return false;	
	}
}

$theme_options = new My_Theme_Options();

function mytheme_option( $option ) {
	$options = get_option( 'dd_theme_options' );
	if ( isset( $options[$option] ) )
		return $options[$option];
	else
		return false;
}
?>
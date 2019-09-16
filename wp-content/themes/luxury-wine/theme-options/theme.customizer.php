<?php
/**
 * Theme customizer
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

//--------------------------------------------------------------
//-- Register Customizer Controls
//--------------------------------------------------------------

define('CUSTOMIZE_PRIORITY', 200);		// Start priority for the new controls

if (!function_exists('luxury_wine_customizer_register_controls')) {
	add_action( 'customize_register', 'luxury_wine_customizer_register_controls', 11 );
	function luxury_wine_customizer_register_controls( $wp_customize ) {

		// Setup standard WP Controls
		// ---------------------------------
		
		// Remove unused sections
		$wp_customize->remove_section( 'colors');
		$wp_customize->remove_section( 'static_front_page');

		// Reorder standard WP sections
		$sec = $wp_customize->get_panel( 'nav_menus' );
		if (is_object($sec)) $sec->priority = 30;
		$sec = $wp_customize->get_panel( 'widgets' );
		if (is_object($sec)) $sec->priority = 40;
		$sec = $wp_customize->get_section( 'title_tagline' );
		if (is_object($sec)) $sec->priority = 50;
		$sec = $wp_customize->get_section( 'background_image' );
		if (is_object($sec)) $sec->priority = 60;
		$sec = $wp_customize->get_section( 'header_image' );
		if (is_object($sec)) $sec->priority = 80;
		$sec = $wp_customize->get_section( 'custom_css' );
		if (is_object($sec)) {
			$sec->title = '* ' . $sec->title;
			$sec->priority = 2000;
		}
		
		// Modify standard WP controls
		$sec = $wp_customize->get_control( 'blogname' );
		if (is_object($sec)) $sec->description      = esc_html__('Use "[[" and "]]" to modify style and color of parts of the text, "||" to break current line', 'luxury-wine');
		$sec = $wp_customize->get_setting( 'blogname' );
		if (is_object($sec)) $sec->transport = 'postMessage';

		$sec = $wp_customize->get_setting( 'blogdescription' );
		if (is_object($sec)) $sec->transport = 'postMessage';
		
		$sec = $wp_customize->get_section( 'background_image' );
		if (is_object($sec)) {
			$sec->title = esc_html__('Background', 'luxury-wine');
			$sec->description = esc_html__('Used only if "Content - Body style" equal to "boxed"', 'luxury-wine');
		}
		
		// Move standard option 'Background Color' to the section 'Background Image'
		$wp_customize->add_setting( 'background_color', array(
			'default'        => get_theme_support( 'custom-background', 'default-color' ),
			'theme_supports' => 'custom-background',
			'transport'		 => 'postMessage',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
			'label'   => esc_html__( 'Background color', 'luxury-wine' ),
			'section' => 'background_image',
		) ) );
		

		// Add Theme specific controls
		// ---------------------------------
		
		$panels = array('');
		$p = 0;
		$sections = array('');
		$s = 0;
		$i = 0;

		// Reload Theme Options before create controls
		if (is_admin()) {
			luxury_wine_storage_set('options_reloaded', true);
			luxury_wine_load_theme_options();
		}
		$options = luxury_wine_storage_get('options');
		
		foreach ($options as $id=>$opt) {
			
			$i++;
			
			if (!empty($opt['hidden'])) continue;
			
			if ($opt['type'] == 'panel') {

				$sec = $wp_customize->get_panel( $id );
				if ( is_object($sec) && !empty($sec->title) ) {
					$sec->title      = $opt['title'];
					$sec->description= $opt['desc'];
					if ( !empty($opt['priority']) )	$sec->priority = $opt['priority'];
				} else {
					$wp_customize->add_panel( esc_attr($id) , array(
						'title'      => $opt['title'],
						'description'=> $opt['desc'],
						'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i
					) );
				}
				array_push($panels, $id);
				$p++;

			} else if ($opt['type'] == 'panel_end') {

				array_pop($panels);
				$p--;

			} else if ($opt['type'] == 'section') {

				$sec = $wp_customize->get_section( $id );
				if ( is_object($sec) && !empty($sec->title) ) {
					$sec->title      = $opt['title'];
					$sec->description= $opt['desc'];
					if ( !empty($opt['priority']) )	$sec->priority = $opt['priority'];
				} else {
					$wp_customize->add_section( esc_attr($id) , array(
						'title'      => $opt['title'],
						'description'=> $opt['desc'],
						'panel'  => esc_attr($panels[$p]),
						'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i
					) );
				}
				array_push($sections, $id);
				$s++;

			} else if ($opt['type'] == 'section_end') {

				array_pop($sections);
				$s--;

			} else if ($opt['type'] == 'select') {

				$wp_customize->add_setting( $id, array(
					'default'           => luxury_wine_get_theme_option($id),
					'sanitize_callback' => 'luxury_wine_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'select',
					'choices'  => $opt['options']
				) );

			} else if ($opt['type'] == 'radio') {

				$wp_customize->add_setting( $id, array(
					'default'           => luxury_wine_get_theme_option($id),
					'sanitize_callback' => 'luxury_wine_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'radio',
					'choices'  => $opt['options']
				) );

			} else if ($opt['type'] == 'switch') {

				$wp_customize->add_setting( $id, array(
					'default'           => luxury_wine_get_theme_option($id),
					'sanitize_callback' => 'luxury_wine_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new Luxury_Wine_Customize_Switch_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'choices'  => $opt['options']
				) ) );

			} else if ($opt['type'] == 'checkbox') {

				$wp_customize->add_setting( $id, array(
					'default'           => luxury_wine_get_theme_option($id),
					'sanitize_callback' => 'luxury_wine_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'checkbox'
				) );

			} else if ($opt['type'] == 'color') {

				$wp_customize->add_setting( $id, array(
					'default'           => luxury_wine_get_theme_option($id),
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'image') {

				$wp_customize->add_setting( $id, array(
					'default'           => luxury_wine_get_theme_option($id),
					'sanitize_callback' => 'luxury_wine_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if (in_array($opt['type'], array('media', 'audio', 'video'))) {

				$wp_customize->add_setting( $id, array(
					'default'           => luxury_wine_get_theme_option($id),
					'sanitize_callback' => 'luxury_wine_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'button') {
			
				$wp_customize->add_setting( $id, array(
					'default'           => luxury_wine_get_theme_option($id),
					'sanitize_callback' => 'luxury_wine_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );

				$wp_customize->add_control( new Luxury_Wine_Customize_Button_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'input_attrs' => array(
						'caption' => $opt['caption'],
						'action' => $opt['action']
					),
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'info') {
			
				$wp_customize->add_setting( $id, array(
					'default'           => '',
					'sanitize_callback' => 'luxury_wine_sanitize_value',
					'transport'         => 'postMessage'
				) );

				$wp_customize->add_control( new Luxury_Wine_Customize_Info_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'hidden') {
			
				$wp_customize->add_setting( $id, array(
					'default'           => luxury_wine_get_theme_option($id),
					'sanitize_callback' => 'luxury_wine_sanitize_html',
					'transport'         => 'postMessage'
				) );

				$wp_customize->add_control( new Luxury_Wine_Customize_Hidden_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else {	

				$wp_customize->add_setting( $id, array(
					'default'           => luxury_wine_get_theme_option($id),
					'sanitize_callback' => 'luxury_wine_sanitize_html',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => $opt['type']
				) );
			}

		}
	}
}


// Create custom controls for customizer
if (!function_exists('luxury_wine_customizer_custom_controls')) {
	add_action( 'customize_register', 'luxury_wine_customizer_custom_controls' );
	function luxury_wine_customizer_custom_controls( $wp_customize ) {
	
		class Luxury_Wine_Customize_Info_Control extends WP_Customize_Control {
			public $type = 'info';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php echo esc_html( $this->description ); ?></span><?php
				}
				?></label><?php
			}
		}
	
		class Luxury_Wine_Customize_Switch_Control extends WP_Customize_Control {
			public $type = 'switch';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php echo esc_html( $this->description ); ?></span><?php
				}
				if (is_array($this->choices) && count($this->choices)>0) {
					foreach ($this->choices as $k=>$v) {
						?><label><input type="radio" name="_customize-radio-<?php echo esc_attr($this->id); ?>" <?php $this->link(); ?> value="<?php echo esc_attr($k); ?>">
						<?php echo esc_html($v); ?></label><?php
					}
				}
				?></label><?php
			}
		}
	
		class Luxury_Wine_Customize_Button_Control extends WP_Customize_Control {
			public $type = 'button';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php echo esc_html( $this->description ); ?></span><?php
				}
				?>
				<input type="button" 
						name="_customize-button-<?php echo esc_attr($this->id); ?>" 
						value="<?php echo esc_attr($this->input_attrs['caption']); ?>"
						data-action="<?php echo esc_attr($this->input_attrs['action']); ?>">
				</label>
				<?php
			}
		}

		class Luxury_Wine_Customize_Hidden_Control extends WP_Customize_Control {
			public $type = 'info';

			public function render_content() {
				?><input type="hidden" name="_customize-hidden-<?php echo esc_attr($this->id); ?>" <?php $this->link(); ?> value=""><?php
			}
		}
	
	}
}


// Sanitize plain value
if (!function_exists('luxury_wine_sanitize_value')) {
	function luxury_wine_sanitize_value($value) {
		return empty($value) ? $value : trim(strip_tags($value));
	}
}


// Sanitize html value
if (!function_exists('luxury_wine_sanitize_html')) {
	function luxury_wine_sanitize_html($value) {
		return empty($value) ? $value : wp_kses_post($value);
	}
}


//--------------------------------------------------------------
// Save custom settings in CSS file
//--------------------------------------------------------------

// Save CSS with custom colors and fonts after save custom options
if (!function_exists('luxury_wine_customizer_action_save_after')) {
	add_action('customize_save_after', 'luxury_wine_customizer_action_save_after');
	function luxury_wine_customizer_action_save_after($api=false) {

		// Get saved settings
		$settings = $api->settings();

		// Store new schemes colors
		$schemes = luxury_wine_unserialize($settings['scheme_storage']->value());
		if (is_array($schemes) && count($schemes) > 0) 
			luxury_wine_storage_set('schemes', $schemes);

		// Store new fonts parameters
		$fonts = luxury_wine_get_theme_fonts();
		foreach ($fonts as $tag=>$v) {
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$fonts[$tag][$css_prop] = $settings["{$tag}_{$css_prop}"]->value();
			}
		}
		luxury_wine_storage_set('theme_fonts', $fonts);

		// Regenerate CSS with new colors
		luxury_wine_customizer_save_css();
	}
}

// Save CSS with custom colors and fonts after switch theme
if (!function_exists('luxury_wine_customizer_action_switch_theme')) {
	add_action('after_switch_theme', 'luxury_wine_customizer_action_switch_theme');
	function luxury_wine_customizer_action_switch_theme() {
		// Remove condition if you want regenerate css after switch to this theme
		if (false) luxury_wine_customizer_save_css();
	}
}

// Save CSS with custom colors and fonts into custom.css
if (!function_exists('luxury_wine_customizer_save_css')) {
	add_action('trx_addons_action_save_options', 'luxury_wine_customizer_save_css');
	function luxury_wine_customizer_save_css() {
		$msg = 	'/* ' . esc_html__("ATTENTION! This file was generated automatically! Don't change it!!!", 'luxury-wine') 
				. "\n----------------------------------------------------------------------- */\n";

		// Save CSS with custom colors and fonts into custom.css
		$css = luxury_wine_customizer_get_css();
		$file = luxury_wine_get_file_dir('css/__colors.css');
		if (file_exists($file)) luxury_wine_fpc($file, $msg . $css );

		// Merge stylesheets
		$list = apply_filters( 'luxury_wine_filter_merge_styles', array() );
		$css = '';
		foreach ($list as $f) {
			$css .= luxury_wine_fgc(luxury_wine_get_file_dir($f));
		}
		if ( $css != '') {
			luxury_wine_fpc( luxury_wine_get_file_dir('css/__styles.css'), $msg . apply_filters( 'luxury_wine_filter_prepare_css', $css, true ) );
		}

		// Merge scripts
		$list = apply_filters( 'luxury_wine_filter_merge_scripts', array(
																	'js/skip-link-focus.js',
																	'js/bideo.js',
																	'js/_utils.js',
																	'js/_init.js'
																	)
							);
		$js = '';
		foreach ($list as $f) {
			$js .= luxury_wine_fgc(luxury_wine_get_file_dir($f));
		}
		if ( $js != '') {
			luxury_wine_fpc( luxury_wine_get_file_dir('js/__scripts.js'), $msg . apply_filters( 'luxury_wine_filter_prepare_js', $js, true ) );
		}
	}
}


//--------------------------------------------------------------
// Border radius settings
//--------------------------------------------------------------

// Return current theme-specific border radius for form's fields and buttons
if ( !function_exists( 'luxury_wine_get_border_radius' ) ) {
	function luxury_wine_get_border_radius() {
		$rad = str_replace(' ', '', luxury_wine_get_theme_option('border_radius'));
		if (empty($rad)) $rad = 0;
		return luxury_wine_prepare_css_value($rad); 
	}
}


//--------------------------------------------------------------
// Color schemes manipulations
//--------------------------------------------------------------

// Load saved values into color schemes
if (!function_exists('luxury_wine_load_schemes')) {
	add_action('luxury_wine_action_load_options', 'luxury_wine_load_schemes');
	function luxury_wine_load_schemes() {
		$schemes = luxury_wine_storage_get('schemes');
		$storage = luxury_wine_unserialize(luxury_wine_get_theme_option('scheme_storage'));
		if (is_array($storage) && count($storage) > 0)  {
			foreach ($storage as $k=>$v) {
				if (isset($schemes[$k])) {
					$schemes[$k] = $v;
				}
			}
			luxury_wine_storage_set('schemes', $schemes);
		}
	}
}

// Return specified color from current (or specified) color scheme
if ( !function_exists( 'luxury_wine_get_scheme_color' ) ) {
	function luxury_wine_get_scheme_color($color_name, $scheme = '') {
		if (empty($scheme)) $scheme = luxury_wine_get_theme_option( 'color_scheme' );
		if (empty($scheme) || luxury_wine_storage_empty('schemes', $scheme)) $scheme = 'default';
		$colors = luxury_wine_storage_get_array('schemes', $scheme, 'colors');
		return $colors[$color_name];
	}
}

// Return colors from current color scheme
if ( !function_exists( 'luxury_wine_get_scheme_colors' ) ) {
	function luxury_wine_get_scheme_colors($scheme = '') {
		if (empty($scheme)) $scheme = luxury_wine_get_theme_option( 'color_scheme' );
		if (empty($scheme) || luxury_wine_storage_empty('schemes', $scheme)) $scheme = 'default';
		return luxury_wine_storage_get_array('schemes', $scheme, 'colors');
	}
}


// Return schemes list
if ( !function_exists( 'luxury_wine_get_list_schemes' ) ) {
	function luxury_wine_get_list_schemes($prepend_inherit=false) {
		$list = array();
		$schemes = luxury_wine_storage_get('schemes');
		if (is_array($schemes) && count($schemes) > 0) {
			foreach ($schemes as $slug => $scheme) {
				$list[$slug] = $scheme['title'];
			}
		}
		return $prepend_inherit ? luxury_wine_array_merge(array('inherit' => esc_html__("Inherit", 'luxury-wine')), $list) : $list;
	}
}


//--------------------------------------------------------------
// Theme fonts
//--------------------------------------------------------------

// Load saved values into fonts list
if (!function_exists('luxury_wine_load_fonts')) {
	add_action('luxury_wine_action_load_options', 'luxury_wine_load_fonts');
	function luxury_wine_load_fonts() {
		// Fonts to load when theme starts
		$fonts = array();
		for ($i=1; $i<=luxury_wine_get_theme_setting('max_load_fonts'); $i++) {
			if (($name = luxury_wine_get_theme_option("load_fonts-{$i}-name")) != '') {
				$fonts[] = array(
					'name'	 => $name,
					'family' => luxury_wine_get_theme_option("load_fonts-{$i}-family"),
					'styles' => luxury_wine_get_theme_option("load_fonts-{$i}-styles")
				);
			}
		}
		luxury_wine_storage_set('load_fonts', $fonts);
		luxury_wine_storage_set('load_fonts_subset', luxury_wine_get_theme_option("load_fonts_subset"));
		
		// Font parameters of the main theme's elements
		$fonts = luxury_wine_get_theme_fonts();
		foreach ($fonts as $tag=>$v) {
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$fonts[$tag][$css_prop] = luxury_wine_get_theme_option("{$tag}_{$css_prop}");
			}
		}
		luxury_wine_storage_set('theme_fonts', $fonts);
	}
}

// Return slug of the loaded font
if (!function_exists('luxury_wine_get_load_fonts_slug')) {
	function luxury_wine_get_load_fonts_slug($name) {
		return str_replace(' ', '-', $name);
	}
}

// Return load fonts parameter's default value
if (!function_exists('luxury_wine_get_load_fonts_option')) {
	function luxury_wine_get_load_fonts_option($option_name) {
		$rez = '';
		$parts = explode('-', $option_name);
		$load_fonts = luxury_wine_storage_get('load_fonts');
		if ($parts[0] == 'load_fonts' && count($load_fonts) > $parts[1]-1 && isset($load_fonts[$parts[1]-1][$parts[2]])) {
			$rez = $load_fonts[$parts[1]-1][$parts[2]];
		}
		return $rez;
	}
}

// Return load fonts subset's default value
if (!function_exists('luxury_wine_get_load_fonts_subset')) {
	function luxury_wine_get_load_fonts_subset($option_name) {
		return luxury_wine_storage_get('load_fonts_subset');
	}
}

// Return load fonts list
if (!function_exists('luxury_wine_get_list_load_fonts')) {
	function luxury_wine_get_list_load_fonts($prepend_inherit=false) {
		$list = array();
		$load_fonts = luxury_wine_storage_get('load_fonts');
		if (is_array($load_fonts) && count($load_fonts) > 0) {
			foreach ($load_fonts as $font) {
				$list[sprintf('%s%s', 
								strpos($font['name'], ' ')!==false ? sprintf('"%s"', $font['name']) : $font['name'],
								!empty($font['family']) ? ', '.trim($font['family']): '')] = $font['name'];
			}
		}
		return $prepend_inherit ? luxury_wine_array_merge(array('inherit' => esc_html__("Inherit", 'luxury-wine')), $list) : $list;
	}
}

// Return font settings of the theme specific elements
if ( !function_exists( 'luxury_wine_get_theme_fonts' ) ) {
	function luxury_wine_get_theme_fonts() {
		return luxury_wine_storage_get('theme_fonts');
	}
}

// Return theme fonts parameter's default value
if (!function_exists('luxury_wine_get_theme_fonts_option')) {
	function luxury_wine_get_theme_fonts_option($option_name) {
		$rez = '';
		$parts = explode('_', $option_name);
		$theme_fonts = luxury_wine_storage_get('theme_fonts');
		if (!empty($theme_fonts[$parts[0]][$parts[1]])) {
			$rez = $theme_fonts[$parts[0]][$parts[1]];
		}
		// For the font-families update options list also
		if ($parts[1] == 'font-family') {
			luxury_wine_storage_set_array2('options', $option_name, 'options', luxury_wine_get_list_load_fonts(true));
		}
		return $rez;
	}
}


//--------------------------------------------------------------
// Customizer JS and CSS
//--------------------------------------------------------------

// Binds JS listener to make Customizer color_scheme control.
// Passes color scheme data as colorScheme global.
if ( !function_exists( 'luxury_wine_customizer_control_js' ) ) {
	add_action( 'customize_controls_enqueue_scripts', 'luxury_wine_customizer_control_js' );
	function luxury_wine_customizer_control_js() {
		wp_enqueue_style( 'luxury-wine-customizer', luxury_wine_get_file_url('theme-options/theme.customizer.css') );
		wp_enqueue_script( 'luxury-wine-customizer-color-scheme-control', luxury_wine_get_file_url('theme-options/theme.customizer.color-scheme.js'), array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), null, true );
		wp_localize_script( 'luxury-wine-customizer-color-scheme-control', 'luxury_wine_color_schemes', luxury_wine_storage_get('schemes') );
		wp_localize_script( 'luxury-wine-customizer-color-scheme-control', 'luxury_wine_theme_fonts', luxury_wine_storage_get('theme_fonts') );
		wp_localize_script( 'luxury-wine-customizer-color-scheme-control', 'luxury_wine_customizer_vars', array(
			'max_load_fonts' => luxury_wine_get_theme_setting('max_load_fonts'),
			'msg_refresh' => esc_html__('Refresh', 'luxury-wine'),
			'msg_reset' => esc_html__('Reset', 'luxury-wine'),
			'msg_reset_confirm' => esc_html__('Are you sure you want to reset all Theme Options?', 'luxury-wine'),
			) );
		wp_localize_script( 'luxury-wine-customizer-color-scheme-control', 'luxury_wine_dependencies', luxury_wine_get_theme_dependencies() );
	}
}

// Binds JS handlers to make the Customizer preview reload changes asynchronously.
if ( !function_exists( 'luxury_wine_customizer_preview_js' ) ) {
	add_action( 'customize_preview_init', 'luxury_wine_customizer_preview_js' );
	function luxury_wine_customizer_preview_js() {
		wp_enqueue_script( 'luxury-wine-customize-preview', luxury_wine_get_file_url('theme-options/theme.customizer.preview.js'), array( 'customize-preview' ), null, true );
	}
}

// Output an Underscore template for generating CSS for the color scheme.
// The template generates the css dynamically for instant display in the Customizer preview.
if ( !function_exists( 'luxury_wine_customizer_css_template' ) ) {
	add_action( 'customize_controls_print_footer_scripts', 'luxury_wine_customizer_css_template' );
	function luxury_wine_customizer_css_template() {
		$colors = array(
			
			// Whole block border and background
			'bg_color'				=> '{{ data.bg_color }}',
			'bd_color'				=> '{{ data.bd_color }}',
			
			// Text and links colors
			'text'					=> '{{ data.text }}',
			'text_light'			=> '{{ data.text_light }}',
			'text_dark'				=> '{{ data.text_dark }}',
			'text_link'				=> '{{ data.text_link }}',
			'text_hover'			=> '{{ data.text_hover }}',
		
			// Alternative blocks (submenu, buttons, tabs, etc.)
			'alter_bg_color'		=> '{{ data.alter_bg_color }}',
			'alter_bg_hover'		=> '{{ data.alter_bg_hover }}',
			'alter_bd_color'		=> '{{ data.alter_bd_color }}',
			'alter_bd_hover'		=> '{{ data.alter_bd_hover }}',
			'alter_text'			=> '{{ data.alter_text }}',
			'alter_light'			=> '{{ data.alter_light }}',
			'alter_dark'			=> '{{ data.alter_dark }}',
			'alter_link'			=> '{{ data.alter_link }}',
			'alter_hover'			=> '{{ data.alter_hover }}',
		
			// Input fields (form's fields and textarea)
			'input_bg_color'		=> '{{ data.input_bg_color }}',
			'input_bg_hover'		=> '{{ data.input_bg_hover }}',
			'input_bd_color'		=> '{{ data.input_bd_color }}',
			'input_bd_hover'		=> '{{ data.input_bd_hover }}',
			'input_text'			=> '{{ data.input_text }}',
			'input_light'			=> '{{ data.input_light }}',
			'input_dark'			=> '{{ data.input_dark }}',

			// Inverse blocks (with background equal to the links color or one of accented colors)
			'inverse_text'			=> '{{ data.inverse_text }}',
			'inverse_light'			=> '{{ data.inverse_light }}',
			'inverse_dark'			=> '{{ data.inverse_dark }}',
			'inverse_link'			=> '{{ data.inverse_link }}',
			'inverse_hover'			=> '{{ data.inverse_hover }}',

			// Additional accented colors (if used in the current theme)
			// For example:
			 'accent2'				=> '{{ data.accent2 }}',
			 'accent2_hover'		=> '{{ data.accent2_hover }}',
			 
			 'button_bg_color'		=> '{{ data.button_bg_color }}',
			 'button_bg_hover'		=> '{{ data.button_bg_hover }}',
			 
			 'simple_bg_hover'		=> '{{ data.simple_bg_hover }}',

		);

		$tmpl_holder = 'script';

		$schemes = array_keys(luxury_wine_get_list_schemes());
		if (count($schemes) > 0) {
			foreach ($schemes as $scheme) {
				echo '<' . esc_html($tmpl_holder) . ' type="text/html" id="tmpl-luxury-wine-color-scheme-'.esc_attr($scheme).'">'
						. luxury_wine_customizer_get_css( $colors, false, false, $scheme )
					. '</' . esc_html($tmpl_holder) . '>';
			}
		}


		// Fonts
		$fonts = luxury_wine_get_theme_fonts();
		if (is_array($fonts) && count($fonts) > 0) {
			foreach ($fonts as $tag => $font) {
				$fonts[$tag]['font-family']		= '{{ data["'.$tag.'"]["font-family"] }}';
				$fonts[$tag]['font-size']		= '{{ data["'.$tag.'"]["font-size"] }}';
				$fonts[$tag]['line-height']		= '{{ data["'.$tag.'"]["line-height"] }}';
				$fonts[$tag]['font-weight']		= '{{ data["'.$tag.'"]["font-weight"] }}';
				$fonts[$tag]['font-style']		= '{{ data["'.$tag.'"]["font-style"] }}';
				$fonts[$tag]['text-decoration']	= '{{ data["'.$tag.'"]["text-decoration"] }}';
				$fonts[$tag]['text-transform']	= '{{ data["'.$tag.'"]["text-transform"] }}';
				$fonts[$tag]['letter-spacing']	= '{{ data["'.$tag.'"]["letter-spacing"] }}';
				$fonts[$tag]['margin-top']		= '{{ data["'.$tag.'"]["margin-top"] }}';
				$fonts[$tag]['margin-bottom']	= '{{ data["'.$tag.'"]["margin-bottom"] }}';
			}
			echo '<'.trim($tmpl_holder).' type="text/html" id="tmpl-luxury-wine-fonts">'
					. trim(luxury_wine_customizer_get_css( false, $fonts, false, false ))
				. '</'.trim($tmpl_holder).'>';
		}

	}
}


// Add scheme name in each selector in the CSS (priority 100 - after complete css)
if (!function_exists('luxury_wine_customizer_add_scheme_in_css')) {
	add_action( 'luxury_wine_filter_get_css', 'luxury_wine_customizer_add_scheme_in_css', 100, 4 );
	function luxury_wine_customizer_add_scheme_in_css($css, $colors, $fonts, $scheme) {
		if ($colors && !empty($css['colors'])) {
			$rez = '';
			$in_comment = $in_rule = false;
			$allow = true;
			$scheme_class = sprintf('.scheme_%s ', $scheme);
			$self_class = '.scheme_self';
			$self_class_len = strlen($self_class);
			$css_str = str_replace(array('{{', '}}'), array('[[',']]'), $css['colors']);
			for ($i=0; $i<strlen($css_str); $i++) {
				$ch = $css_str[$i];
				if ($in_comment) {
					$rez .= $ch;
					if ($ch=='/' && $css_str[$i-1]=='*') {
						$in_comment = false;
						$allow = !$in_rule;
					}
				} else if ($in_rule) {
					$rez .= $ch;
					if ($ch=='}') {
						$in_rule = false;
						$allow = !$in_comment;
					}
				} else {
					if ($ch=='/' && $css_str[$i+1]=='*') {
						$rez .= $ch;
						$in_comment = true;
					} else if ($ch=='{') {
						$rez .= $ch;
						$in_rule = true;
					} else if ($ch==',') {
						$rez .= $ch;
						$allow = true;
					} else if (strpos(" \t\r\n", $ch)===false) {
						if ($allow && substr($css_str, $i, $self_class_len) == $self_class) {
							$rez .= trim($scheme_class);
							$i += $self_class_len - 1;
						} else
							$rez .= ($allow ? $scheme_class : '') . $ch;
						$allow = false;
					} else {
						$rez .= $ch;
					}
				}
			}
			$rez = str_replace(array('[[',']]'), array('{{', '}}'), $rez);
			$css['colors'] = $rez;
		}
		return $css;
	}
}
	



// -----------------------------------------------------------------
// -- Page Options section
// -----------------------------------------------------------------

if ( !function_exists('luxury_wine_options_override_init') ) {
	add_action( 'after_setup_theme', 'luxury_wine_options_override_init' );
	function luxury_wine_options_override_init() {
		if ( is_admin() ) {
			add_action("admin_enqueue_scripts", 'luxury_wine_options_override_add_scripts');
			add_action('save_post',			'luxury_wine_options_override_save_options');
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'luxury_wine_options_override_add_scripts' ) ) {
	add_action("admin_enqueue_scripts", 'luxury_wine_options_override_add_scripts');
	function luxury_wine_options_override_add_scripts() {
		// If current screen is 'Edit Page' - load fontello
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && luxury_wine_options_allow_override(!empty($screen->post_type) ? $screen->post_type : $screen->id)) {
			wp_enqueue_style( 'fontello',  luxury_wine_get_file_url('css/fontello/fontello-embedded.css') );
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui'), null, true);
			wp_enqueue_script( 'luxury-wine-override', luxury_wine_get_file_url('theme-options/theme.override.js'), array('jquery'), null, true );
			wp_localize_script( 'luxury-wine-override', 'luxury_wine_dependencies', luxury_wine_get_theme_dependencies() );
		}
	}
}


// Check if override is allow
if (!function_exists('luxury_wine_options_allow_override')) {
	function luxury_wine_options_allow_override($post_type) {
		return apply_filters('luxury_wine_filter_allow_override', in_array($post_type, array('page', 'post')), $post_type);
	}
}

// Add overriden options
if (!function_exists('luxury_wine_options_override_add_options')) {
    add_filter('luxury_wine_filter_override_options', 'luxury_wine_options_override_add_options');
    function luxury_wine_options_override_add_options($list) {
        global $post_type;
        if (luxury_wine_options_allow_override($post_type)) {
            $list[] = array(sprintf('luxury_wine_override_options_%s', $post_type),
                esc_html__('Theme Options', 'luxury-wine'),
                'luxury_wine_options_override_show',
                $post_type,
                $post_type=='post' ? 'side' : 'advanced',
                'default'
            );
        }
        return $list;
    }
}


// Callback function to show fields in override
if (!function_exists('luxury_wine_options_override_show')) {
	function luxury_wine_options_override_show() {
		global $post, $post_type;
		if (luxury_wine_options_allow_override($post_type)) {
			// Load saved options 
			$meta = get_post_meta($post->ID, 'luxury_wine_options', true);
			$tabs_titles = $tabs_content = array();
			global $LUXURY_WINE_STORAGE;
			// Refresh linked data if this field is controller for the another (linked) field
			// Do this before show fields to refresh data in the $LUXURY_WINE_STORAGE
			foreach ($LUXURY_WINE_STORAGE['options'] as $k=>$v) {
				if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
				if (!empty($v['linked'])) {
					$v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
					if (!empty($v['val']) && !luxury_wine_is_inherit($v['val']))
						luxury_wine_refresh_linked_data($v['val'], $v['linked']);
				}
			}
			// Show fields
			foreach ($LUXURY_WINE_STORAGE['options'] as $k=>$v) {
				if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
				if (empty($v['override']['section']))
					$v['override']['section'] = esc_html__('General', 'luxury-wine');
				if (!isset($tabs_titles[$v['override']['section']])) {
					$tabs_titles[$v['override']['section']] = $v['override']['section'];
					$tabs_content[$v['override']['section']] = '';
				}
				$v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
				$tabs_content[$v['override']['section']] .= luxury_wine_options_override_show_field($k, $v);
			}
			if (count($tabs_titles) > 0) {
				?>
				<div class="luxury_wine_override">
					<input type="hidden" name="override_post_nonce" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" />
					<input type="hidden" name="override_post_type" value="<?php echo esc_attr($post_type); ?>" />
					<div id="luxury_wine_override_tabs">
						<ul><?php
							$cnt = 0;
							foreach ($tabs_titles as $k=>$v) {
								$cnt++;
								?><li><a href="#luxury_wine_override_<?php echo esc_attr($cnt); ?>"><?php echo esc_html($v); ?></a></li><?php
							}
						?></ul>
						<?php
							$cnt = 0;
							foreach ($tabs_content as $k=>$v) {
								$cnt++;
								?>
								<div id="luxury_wine_override_<?php echo esc_attr($cnt); ?>" class="luxury_wine_override_section">
									<?php luxury_wine_show_layout($v); ?>
								</div>
								<?php
							}
						?>
					</div>
				</div>
				<?php		
			}
		}
	}
}

// Display single option's field
if ( !function_exists('luxury_wine_options_override_show_field') ) {
	function luxury_wine_options_override_show_field($name, $field) {
		if ($field['type'] == 'hidden') return '';
		$inherit_state = luxury_wine_is_inherit($field['val']);
		$output = '<div class="luxury_wine_override_item luxury_wine_override_item_'.esc_attr($field['type']).' luxury_wine_override_inherit_'.($inherit_state ? 'on' : 'off' ).'">'
						. '<h4 class="luxury_wine_override_item_title">'
							. esc_html($field['title'])
							. '<span class="luxury_wine_override_inherit_lock" id="luxury_wine_override_inherit_'.esc_attr($name).'"></span>'
						. '</h4>'
						. '<div class="luxury_wine_override_item_data">'
							. '<div class="luxury_wine_override_item_field" data-param="'.esc_attr($name).'"'.(!empty($field['linked']) ? ' data-linked="'.esc_attr($field['linked']).'"' : '').'>';
		if ($field['type']=='checkbox') {
			$output .= '<label class="luxury_wine_override_item_label">'
						. '<input type="checkbox" name="luxury_wine_override_field_'.esc_attr($name).'" value="1"'.($field['val']==1 ? ' checked="checked"' : '').' />'
						. esc_html($field['title'])
					. '</label>';
		} else if ($field['type']=='switch' || $field['type']=='radio') {
			foreach ($field['options'] as $k=>$v) {
				$output .= '<label class="luxury_wine_override_item_label">'
							. '<input type="radio" name="luxury_wine_override_field_'.esc_attr($name).'" value="'.esc_attr($k).'"'.($field['val']==$k ? ' checked="checked"' : '').' />'
							. esc_html($v)
						. '</label>';
			}
		} else if ($field['type']=='text') {
			$output .= '<input type="text" name="luxury_wine_override_field_'.esc_attr($name).'" value="'.esc_attr(luxury_wine_is_inherit($field['val']) ? '' : $field['val']).'" />';
		} else if ($field['type']=='textarea') {
			$output .= '<textarea name="luxury_wine_override_field_'.esc_attr($name).'">'.esc_html(luxury_wine_is_inherit($field['val']) ? '' : $field['val']).'</textarea>';
		} else if ($field['type']=='select') {
			$output .= '<select size="1" name="luxury_wine_override_field_'.esc_attr($name).'">';
			foreach ($field['options'] as $k=>$v) {
				$output .= '<option value="'.esc_attr($k).'"'.($field['val']==$k ? ' selected="selected"' : '').'>'.esc_html($v).'</option>';
			}
			$output .= '</select>';
		} else if (in_array($field['type'], array('image', 'media', 'video', 'audio'))) {
			$output .= '<input type="text" id="luxury_wine_override_field_'.esc_attr($name).'" name="luxury_wine_override_field_'.esc_attr($name).'" value="'.esc_attr(luxury_wine_is_inherit($field['val']) ? '' : $field['val']).'" />'
					. luxury_wine_show_custom_field('luxury_wine_override_field_'.esc_attr($name).'_button', array(
														'type'				=> 'mediamanager',
														'data_type'			=> $field['type'],
														'linked_field_id'	=> 'luxury_wine_override_field_'.esc_attr($name)),
														null)
					. '<div class="luxury_wine_override_field_preview">'
						. (luxury_wine_is_inherit($field['val']) ? '' : ($field['val'] && $field['type']=='image' ? '<img src="' . esc_url($field['val']) . '" alt="' . esc_html(basename($field['val'])) . '">' : basename($field['val'])))
					. '</div>';
		}
		$output .= '<div class="luxury_wine_override_inherit_cover'.(!$inherit_state ? ' luxury_wine_hidden' : '').'">'
							. '<span class="luxury_wine_override_inherit_label">' . esc_html__('Inherit', 'luxury-wine') . '</span>'
							. '<input type="hidden" name="luxury_wine_override_inherit_'.esc_attr($name).'" value="'.esc_attr($inherit_state ? 'inherit' : '').'" />'
						. '</div>'
					. '</div>'
					. '<div class="luxury_wine_override_item_description">'
						. (!empty($field['override']['desc']) ? $field['override']['desc'] : $field['desc'])	// param 'desc' already processed with wp_kses()!
					. '</div>'
				. '</div>'
			. '</div>';
		return $output;
	}
}

// Save data from override
if (!function_exists('luxury_wine_options_override_save_options')) {
	//Handler of the add_action('save_post', 'luxury_wine_options_override_save_options');
	function luxury_wine_options_override_save_options($post_id) {

		// verify nonce
		if ( !wp_verify_nonce( luxury_wine_get_value_gp('override_post_nonce'), admin_url() ) )
			return $post_id;

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		$post_type = isset($_POST['override_post_type']) ? $_POST['override_post_type'] : $_POST['post_type'];

		// check permissions
		$capability = 'page';
		$post_types = get_post_types( array( 'name' => $post_type), 'objects' );
		if (!empty($post_types) && is_array($post_types)) {
			foreach ($post_types  as $type) {
				$capability = $type->capability_type;
				break;
			}
		}
		if (!current_user_can('edit_'.($capability), $post_id)) {
			return $post_id;
		}

		// Save meta
		$meta = array();
		$options = luxury_wine_storage_get('options');
		foreach ($options as $k=>$v) {
			// Skip not overriden options
			if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
			// Skip inherited options
			if (!empty($_POST['luxury_wine_override_inherit_' . $k])) continue;
			// Get option value from POST
			$meta[$k] = isset($_POST['luxury_wine_override_field_' . $k])
							? $_POST['luxury_wine_override_field_' . $k]
							: ($v['type']=='checkbox' ? 0 : '');
		}
		update_post_meta($post_id, 'luxury_wine_options', $meta);
		
		// Save separate meta options to search template pages
		if ($post_type=='page' && !empty($_POST['page_template']) && $_POST['page_template']=='blog.php') {
			update_post_meta($post_id, 'luxury_wine_options_post_type', isset($meta['post_type']) ? $meta['post_type'] : 'post');
			update_post_meta($post_id, 'luxury_wine_options_parent_cat', isset($meta['parent_cat']) ? $meta['parent_cat'] : 0);
		}
	}
}

// Refresh data in the linked field
// according the main field value
if (!function_exists('luxury_wine_refresh_linked_data')) {
	function luxury_wine_refresh_linked_data($value, $linked_name) {
		if ($linked_name == 'parent_cat') {
			$tax = luxury_wine_get_post_type_taxonomy($value);
			$terms = !empty($tax) ? luxury_wine_get_list_terms(false, $tax) : array();
			$terms = luxury_wine_array_merge(array(0 => esc_html__('- Select category -', 'luxury-wine')), $terms);
			luxury_wine_storage_set_array2('options', $linked_name, 'options', $terms);
		}
	}
}

// AJAX: Refresh data in the linked fields
if (!function_exists('luxury_wine_callback_get_linked_data')) {
	add_action('wp_ajax_luxury_wine_get_linked_data', 		'luxury_wine_callback_get_linked_data');
	add_action('wp_ajax_nopriv_luxury_wine_get_linked_data','luxury_wine_callback_get_linked_data');
	function luxury_wine_callback_get_linked_data() {
		if ( !wp_verify_nonce( luxury_wine_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
            wp_die();
		$chg_name = $_REQUEST['chg_name'];
		$chg_value = $_REQUEST['chg_value'];
		$response = array('error' => '');
		if ($chg_name == 'post_type') {
			$tax = luxury_wine_get_post_type_taxonomy($chg_value);
			$terms = !empty($tax) ? luxury_wine_get_list_terms(false, $tax) : array();
			$response['list'] = luxury_wine_array_merge(array(0 => esc_html__('- Select category -', 'luxury-wine')), $terms);
		}
		echo json_encode($response);
        wp_die();
	}
}



//--------------------------------------------------------------
//-- Load Options list and styles
//--------------------------------------------------------------
require_once trailingslashit( get_template_directory() ) . 'theme-options/theme.options.php';
require_once trailingslashit( get_template_directory() ) . 'theme-options/theme.styles.php';
?>
<?php
/**
 * Generate custom CSS
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */


			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('luxury_wine_customizer_add_theme_colors')) {
	function luxury_wine_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = luxury_wine_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = luxury_wine_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = luxury_wine_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = luxury_wine_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = luxury_wine_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = luxury_wine_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = luxury_wine_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = luxury_wine_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = luxury_wine_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['alter_bd_color_04']  = luxury_wine_hex2rgba( $colors['alter_bd_color'], 0.4 );
			$colors['text_dark_06']  = luxury_wine_hex2rgba( $colors['text_dark'], 0.6 );
			$colors['text_dark_07']  = luxury_wine_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = luxury_wine_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = luxury_wine_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_blend'] = luxury_wine_hsb2hex(luxury_wine_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = luxury_wine_hsb2hex(luxury_wine_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
			$colors['alter_hover_05']  = luxury_wine_hex2rgba( $colors['alter_hover'], 0.5 );
			$colors['accent2_hover_005']  = luxury_wine_hex2rgba( $colors['accent2_hover'], 0.05 );
			$colors['accent2_hover_02']  = luxury_wine_hex2rgba( $colors['accent2_hover'], 0.2 );
			$colors['accent2_hover_05']  = luxury_wine_hex2rgba( $colors['accent2_hover'], 0.5 );
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['alter_bd_color_04'] = '{{ data.alter_bd_color_04 }}';
			$colors['text_dark_06'] = '{{ data.text_dark_06 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
			$colors['alter_hover_05'] = '{{ data.alter_hover_05 }}';
			$colors['accent2_hover_005'] = '{{ data.accent2_hover_005 }}';
			$colors['accent2_hover_02'] = '{{ data.accent2_hover_02}}';
			$colors['accent2_hover_05'] = '{{ data.accent2_hover_05 }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('luxury_wine_customizer_add_theme_fonts')) {
	function luxury_wine_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !luxury_wine_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !luxury_wine_is_inherit($font['font-size'])
														? 'font-size:' . luxury_wine_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !luxury_wine_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !luxury_wine_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !luxury_wine_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !luxury_wine_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !luxury_wine_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !luxury_wine_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !luxury_wine_is_inherit($font['margin-top'])
														? 'margin-top:' . luxury_wine_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !luxury_wine_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . luxury_wine_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}


// Return CSS with custom colors and fonts
if (!function_exists('luxury_wine_customizer_get_css')) {

	function luxury_wine_customizer_get_css($colors=null, $fonts=null, $remove_spaces=true, $only_scheme='') {

		$css = array(
			'fonts' => '',
			'colors' => ''
		);
		
		// Theme fonts
		//---------------------------------------------
		if ($fonts === null) {
			$fonts = luxury_wine_get_theme_fonts();
		}
		
		if ($fonts) {

			// Make theme-specific fonts rules
			$fonts = luxury_wine_customizer_add_theme_fonts($fonts);

			$rez = array();
			$rez['fonts'] = <<<CSS

body {
	{$fonts['p_font-family']}
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['p_font-style']}
	{$fonts['p_line-height']}
	{$fonts['p_text-decoration']}
	{$fonts['p_text-transform']}
	{$fonts['p_letter-spacing']}
}
p, ul, ol, dl, blockquote, address {
	{$fonts['p_margin-top']}
	{$fonts['p_margin-bottom']}
}

h1 {
	{$fonts['h1_font-family']}
	{$fonts['h1_font-size']}
	{$fonts['h1_font-weight']}
	{$fonts['h1_font-style']}
	{$fonts['h1_line-height']}
	{$fonts['h1_text-decoration']}
	{$fonts['h1_text-transform']}
	{$fonts['h1_letter-spacing']}
	{$fonts['h1_margin-top']}
	{$fonts['h1_margin-bottom']}
}
h2 {
	{$fonts['h2_font-family']}
	{$fonts['h2_font-size']}
	{$fonts['h2_font-weight']}
	{$fonts['h2_font-style']}
	{$fonts['h2_line-height']}
	{$fonts['h2_text-decoration']}
	{$fonts['h2_text-transform']}
	{$fonts['h2_letter-spacing']}
	{$fonts['h2_margin-top']}
	{$fonts['h2_margin-bottom']}
}
h3 {
	{$fonts['h3_font-family']}
	{$fonts['h3_font-size']}
	{$fonts['h3_font-weight']}
	{$fonts['h3_font-style']}
	{$fonts['h3_line-height']}
	{$fonts['h3_text-decoration']}
	{$fonts['h3_text-transform']}
	{$fonts['h3_letter-spacing']}
	{$fonts['h3_margin-top']}
	{$fonts['h3_margin-bottom']}
}
h4 {
	{$fonts['h4_font-family']}
	{$fonts['h4_font-size']}
	{$fonts['h4_font-weight']}
	{$fonts['h4_font-style']}
	{$fonts['h4_line-height']}
	{$fonts['h4_text-decoration']}
	{$fonts['h4_text-transform']}
	{$fonts['h4_letter-spacing']}
	{$fonts['h4_margin-top']}
	{$fonts['h4_margin-bottom']}
}
h5 {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-size']}
	{$fonts['h5_font-weight']}
	{$fonts['h5_font-style']}
	{$fonts['h5_line-height']}
	{$fonts['h5_text-decoration']}
	{$fonts['h5_text-transform']}
	{$fonts['h5_letter-spacing']}
	{$fonts['h5_margin-top']}
	{$fonts['h5_margin-bottom']}
}
h6 {
	{$fonts['h6_font-family']}
	{$fonts['h6_font-size']}
	{$fonts['h6_font-weight']}
	{$fonts['h6_font-style']}
	{$fonts['h6_line-height']}
	{$fonts['h6_text-decoration']}
	{$fonts['h6_text-transform']}
	{$fonts['h6_letter-spacing']}
	{$fonts['h6_margin-top']}
	{$fonts['h6_margin-bottom']}
}

input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="search"],
input[type="password"],
textarea,
textarea.wp-editor-area,
.select_container,
select,
.select_container select {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}

button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.gallery_preview_show .post_readmore,
.more-link,
.luxury_wine_tabs .luxury_wine_tabs_titles li a {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

.top_panel .slider_engine_revo .slide_title {
	{$fonts['h1_font-family']}
}

mark, ins,
.logo_text,
.post_price.price,
.theme_scroll_down,
.single .sc_layouts_title .post_categories,
.post_layout_chess .post_tags  {
	{$fonts['h5_font-family']}
}

.post_meta {
	{$fonts['info_font-family']}
	{$fonts['info_font-size']}
	{$fonts['info_font-weight']}
	{$fonts['info_font-style']}
	{$fonts['info_line-height']}
	{$fonts['info_text-decoration']}
	{$fonts['info_text-transform']}
	{$fonts['info_letter-spacing']}
	{$fonts['info_margin-top']}
	{$fonts['info_margin-bottom']}
}

em, i,
.post-date, .rss-date 
.post_date, .post_meta_item, .post_counters_item,
.comments_list_wrap .comment_date,
.comments_list_wrap .comment_time,
.comments_list_wrap .comment_counters,
.top_panel .slider_engine_revo .slide_subtitle,
.logo_slogan,
fieldset legend,
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd,
.format-audio .post_featured .post_audio_author,
.post_item_single .post_content .post_meta,
.author_bio .author_link,
.comments_list_wrap .comment_posted,
.comments_list_wrap .comment_reply {
	{$fonts['info_font-family']}
}
.search_wrap .search_results .post_meta_item,
.search_wrap .search_results .post_counters_item,
.minimal-light .esg-grid .esg-filterbutton {
	{$fonts['p_font-family']}
}

.logo_text {
	{$fonts['logo_font-family']}
	{$fonts['logo_font-size']}
	{$fonts['logo_font-weight']}
	{$fonts['logo_font-style']}
	{$fonts['logo_line-height']}
	{$fonts['logo_text-decoration']}
	{$fonts['logo_text-transform']}
	{$fonts['logo_letter-spacing']}
}
.logo_footer_text {
	{$fonts['logo_font-family']}
}

.menu_main_nav_area {
	{$fonts['menu_font-size']}
	{$fonts['menu_line-height']}
}
.menu_main_nav > li,
.menu_main_nav > li > a {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.menu_main_nav > li ul,
.menu_main_nav > li ul > li,
.menu_main_nav > li ul > li > a {
	{$fonts['submenu_font-family']}
	{$fonts['submenu_font-size']}
	{$fonts['submenu_font-weight']}
	{$fonts['submenu_font-style']}
	{$fonts['submenu_line-height']}
	{$fonts['submenu_text-decoration']}
	{$fonts['submenu_text-transform']}
	{$fonts['submenu_letter-spacing']}
}
.menu_mobile .menu_mobile_nav_area > ul > li,
.menu_mobile .menu_mobile_nav_area > ul > li > a {
	{$fonts['menu_font-family']}
}
.menu_mobile .menu_mobile_nav_area > ul > li li,
.menu_mobile .menu_mobile_nav_area > ul > li li > a {
	{$fonts['submenu_font-family']}
}


/* Custom Headers */
.sc_layouts_row,
.sc_layouts_row input[type="text"] {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-size']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_line-height']}
}
.sc_layouts_row .sc_button_wrap .sc_button {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
.sc_layouts_menu_nav > li,
.sc_layouts_menu_nav > li > a {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.sc_layouts_menu_nav > li ul,
.sc_layouts_menu_nav > li ul > li,
.sc_layouts_menu_nav > li ul > li > a {
	{$fonts['submenu_font-family']}
	{$fonts['submenu_font-size']}
	{$fonts['submenu_font-weight']}
	{$fonts['submenu_font-style']}
	{$fonts['submenu_line-height']}
	{$fonts['submenu_text-decoration']}
	{$fonts['submenu_text-transform']}
	{$fonts['submenu_letter-spacing']}
}

CSS;
			$rez = apply_filters('luxury_wine_filter_get_css', $rez, false, $fonts, '');
			$css['fonts'] = $rez['fonts'];

			
			// Border radius
			//--------------------------------------
			$rad = luxury_wine_get_border_radius();
			$rad50 = ' '.$rad != ' 0' ? '50%' : 0;
			$css['fonts'] .= <<<CSS

/* Buttons */
button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.post_item .more-link,
.gallery_preview_show .post_readmore,

/* Fields */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="password"],
input[type="search"],
select,
.select_container,
textarea,

/* Search fields */
.widget_search .search-field,
.woocommerce.widget_product_search .search_field,
.widget_display_search #bbp_search,
#bbpress-forums #bbp-search-form #bbp_search,

/* Comment fields */
.comments_wrap .comments_field input,
.comments_wrap .comments_field textarea,

/* Tags cloud */
.widget_product_tag_cloud a,
.widget_tag_cloud a {
	-webkit-border-radius: {$rad};
	   -moz-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}
.select_container:before {
	-webkit-border-radius: 0 {$rad} {$rad} 0;
	   -moz-border-radius: 0 {$rad} {$rad} 0;
	    -ms-border-radius: 0 {$rad} {$rad} 0;
			border-radius: 0 {$rad} {$rad} 0;
}
textarea.wp-editor-area {
	-webkit-border-radius: 0 0 {$rad} {$rad};
	   -moz-border-radius: 0 0 {$rad} {$rad};
	    -ms-border-radius: 0 0 {$rad} {$rad};
			border-radius: 0 0 {$rad} {$rad};
}

/* Radius 50% or 0 */
.widget li a img {
	-webkit-border-radius: {$rad50};
	   -moz-border-radius: {$rad50};
	    -ms-border-radius: {$rad50};
			border-radius: {$rad50};
}

CSS;
		}


		// Theme colors
		//--------------------------------------
		if ($colors !== false) {
			$schemes = empty($only_scheme) ? array_keys(luxury_wine_get_list_schemes()) : array($only_scheme);
	
			if (count($schemes) > 0) {
				$rez = array();
				foreach ($schemes as $scheme) {
					// Prepare colors
					if (empty($only_scheme)) $colors = luxury_wine_get_scheme_colors($scheme);
	
					// Make theme-specific colors and tints
					$colors = luxury_wine_customizer_add_theme_colors($colors);
			
					// Make styles
					$rez['colors'] = <<<CSS

/* Common tags */
h1, h2, h3, h4, h5, h6,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
li a {
	color: {$colors['text_dark']};
}
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
li a:hover {
	color: {$colors['text_link']};
}

dt, b, strong, i, em, mark, ins {	
	color: {$colors['text_dark']};
}
s, strike, del {	
	color: {$colors['text_light']};
}

code {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
code a {
	color: {$colors['alter_link']};
}
code a:hover {
	color: {$colors['alter_hover']};
}

a {
	color: {$colors['text_link']};
}
a:hover {
	color: {$colors['text_hover']};
}

blockquote {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
blockquote:before {
	color: {$colors['text_link']};
}
blockquote a {
	color: {$colors['bg_color']};
}
blockquote a:hover {
	color: {$colors['text_link']};
}
.scheme_default blockquote.trx_addons_blockquote_style_1{
	color: {$colors['accent2']};
}

/*
table th, table th + th, table td + th  {
	border-color: {$colors['bg_color_02']};
}
table td, table th + td, table td + td {
	color: {$colors['alter_dark']};
	border-color: {$colors['bg_color']};
}
table th {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
table > tbody > tr:nth-child(2n+1) > td {
	background-color: {$colors['alter_bg_color_04']};
}
table > tbody > tr:nth-child(2n) > td {
	background-color: {$colors['alter_bg_color_02']};
}
table th a:hover {
	color: {$colors['bg_color']};
}*/

hr {
	border-color: {$colors['bd_color']};
}
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_dark_06']};
}
ul > li:before {
	color: {$colors['alter_hover']};
}


/* Form fields */


button[disabled],
input[type="button"][disabled],
.comments_wrap .form-submit input[type="submit"][disabled]{
    background-color: {$colors['text_light']} !important;
    color: {$colors['text']} !important;
}

input[type="submit"][disabled],
.mc-btn input[type="submit"][disabled]+ span{
     color: {$colors['text']} !important;
}

fieldset {
	border-color: {$colors['bd_color']};
}
fieldset legend {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}

::-webkit-input-placeholder { color: {$colors['text_light']}; }
::-moz-placeholder          { color: {$colors['text_light']}; }
:-ms-input-placeholder      { color: {$colors['text_light']}; }

input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="search"],
input[type="password"],
.select_container,
.select2-container .select2-choice,
textarea,
textarea.wp-editor-area {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
input[type="text"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
input[type="search"]:focus,
input[type="password"]:focus,
.select_container:hover,
select option:hover,
select option:focus,
.select2-container .select2-choice:hover,
textarea:focus,
textarea.wp-editor-area:focus {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
	background-color: {$colors['input_bg_hover']};
}
.select_container:before {
	color: {$colors['input_text']};
	background-color: {$colors['input_bg_color']};
}
.select_container:focus:before,
.select_container:hover:before {
	color: {$colors['input_dark']};
	background-color: {$colors['input_bg_hover']};
}
.select_container:after {
	color: {$colors['input_text']};
}
.select_container:focus:after,
.select_container:hover:after {
	color: {$colors['input_dark']};
}
.select_container select {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
}
.select_container select:focus {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
}

.widget_search form:after,
.woocommerce.widget_product_search form:after,
.widget_display_search form:after,
#bbpress-forums #bbp-search-form:after {
	color: {$colors['input_text']};
}
.widget_search form:hover:after,
.woocommerce.widget_product_search form:hover:after,
.widget_display_search form:hover:after,
#bbpress-forums #bbp-search-form:hover:after {
	color: {$colors['input_dark']};
}

input[type="radio"] + label:before,
input[type="checkbox"] + label:before {
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
button,
input[type="reset"],
input[type="submit"],
input[type="button"] {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
input[type="submit"]:hover,
input[type="reset"]:hover,
input[type="button"]:hover,
button:hover,
input[type="submit"]:focus,
input[type="reset"]:focus,
input[type="button"]:focus,
button:focus {
	color: {$colors['inverse_hover']};
	background-color: {$colors['text_link_blend']};
}
.wp-editor-container input[type="button"] {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_dark']};
	-webkit-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
	   -moz-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
			box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};	
}
.wp-editor-container input[type="button"]:hover,
.wp-editor-container input[type="button"]:focus {
	background-color: {$colors['alter_bg_hover']};
	border-color: {$colors['alter_bd_hover']};
	color: {$colors['alter_link']};
}

.select2-results {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_hover']};
	background: {$colors['input_bg_color']};
}
.select2-results .select2-highlighted {
	color: {$colors['input_dark']};
	background: {$colors['input_bg_hover']};
}


/* WP Standard classes */
.sticky {
	border-color: {$colors['bd_color']};
}
.sticky .label_sticky {
	border-top-color: {$colors['text_link']};
}
	

/* Page */
body {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}
#page_preloader,
.scheme_self.header_position_under .page_content_wrap,
.page_wrap {
	background-color: {$colors['bg_color']};
}
.preloader_wrap > div {
	background-color: {$colors['text_link']};
}

/* Header
------------------------------------------------ */
.scheme_self.top_panel.with_bg_image:before {
	background-color: {$colors['bg_color_07']};
}
.scheme_self.top_panel .slider_engine_revo .slide_subtitle,
.top_panel .slider_engine_revo .slide_subtitle {
	color: {$colors['text_link']};
}
.top_panel_default .top_panel_title,
.scheme_self.top_panel_default .top_panel_title {
	background-color: {$colors['alter_bg_color']};
}

/* Custom Headers
----------------------------------------- */

.sc_layouts_row_delimiter,
.scheme_self.sc_layouts_row_delimiter {
	border-color: {$colors['bd_color']};
}
.footer_wrap .sc_layouts_row_delimiter,
.scheme_self.footer_wrap .sc_layouts_row_delimiter {
	border-color: {$colors['alter_bd_color']};
}
.sc_layouts_item_details_line1 {
	color: {$colors['accent2']};
}
.sc_layouts_item_details_line2 {
	color: {$colors['accent2_hover']};
}
.sc_layouts_row_fixed_on {
	background-color: {$colors['bg_color_09']};
}
.sc_layouts_row .sc_layouts_item,
.scheme_self.sc_layouts_row .sc_layouts_item {
	color: {$colors['text']};
}
.sc_layouts_row_type_normal .sc_layouts_item a,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item a {
	color: {$colors['accent2']};
}
.sc_layouts_row .sc_layouts_item a:hover,
.scheme_self.sc_layouts_row .sc_layouts_item a:hover,
.sc_layouts_row .sc_layouts_item a:hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['text_link']};
}
.sc_layouts_row .search_wrap .search_field{
	color: {$colors['inverse_light']};
	background-color: {$colors['text_hover']};	
}

.sc_layouts_row .search_wrap .search_submit,
.scheme_self.sc_layouts_row .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['accent2_hover']};
}
.sc_layouts_row .search_wrap .search_submit:hover,
.scheme_self.sc_layouts_row .search_wrap .search_submit:hover {
	background-color: transparent;
	color: {$colors['input_text']};
}
.sc_layouts_item_icon, 
.fa.sc_layouts_item_icon{
	border-color: {$colors['accent2_hover_05']};
	color: {$colors['accent2_hover']};
}

/* Row type: Narrow */
.sc_layouts_row.sc_layouts_row_type_narrow,
.scheme_self.sc_layouts_row.sc_layouts_row_type_narrow {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.sc_layouts_row_type_narrow .sc_layouts_item,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .sc_layouts_item a,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .sc_layouts_item a:hover,
.sc_layouts_row_type_narrow .sc_layouts_item a:hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['alter_dark']};
}
.sc_layouts_row_type_narrow .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_icon {
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .sc_layouts_item_details_line1,
.sc_layouts_row_type_narrow .sc_layouts_item_details_line2,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_details_line1,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_details_line2 {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .sc_button_wrap .sc_button,
.scheme_self.sc_layouts_row_type_narrow .sc_button_wrap .sc_button {
	background-color: transparent;
	border-color: {$colors['alter_link']};
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .sc_button_wrap .sc_button:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button_wrap .sc_button:hover {
	background-color: transparent;
	border-color: {$colors['alter_hover']};
	color: {$colors['alter_hover']} !important;
}

.sc_layouts_row_type_narrow .search_wrap .search_submit,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field::-webkit-input-placeholder,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field::-webkit-input-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field::-moz-placeholder,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field::-moz-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field:-ms-input-placeholder,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field:-ms-input-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field:focus,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field:focus {
	color: {$colors['alter_dark']};
}


/* Row type: Compact */
.sc_layouts_row_type_compact .sc_layouts_item_icon, 
.sc_layouts_row_type_compact .fa.sc_layouts_item_icon,
.sc_layouts_row_type_compact .search_wrap .search_submit{
	color: {$colors['accent2_hover_05']};
}
.sc_layouts_row_type_compact .sc_layouts_menu:after{
	background-color: {$colors['accent2_hover_02']};	
}
/*
.sc_layouts_row_type_compact .sc_layouts_item,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .sc_layouts_item a,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .sc_layouts_item a:hover,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:hover,
.sc_layouts_row_type_compact .sc_layouts_item a:hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['text_dark']};
}
.sc_layouts_row_type_compact .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_icon {
	color: {$colors['text_link']};
}
.sc_layouts_row_type_compact .sc_layouts_item_details_line1,
.sc_layouts_row_type_compact .sc_layouts_item_details_line2,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_details_line1,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_details_line2 {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .search_wrap .search_submit,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['text_dark']};
}
.sc_layouts_row_type_compact .search_wrap .search_submit:hover,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_submit:hover {
	background-color: transparent;
	color: {$colors['text_hover']};
}
.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit,
.scheme_self.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit {
	color: {$colors['text_link']};
}
.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit:hover,
.scheme_self.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit:hover {
	color: {$colors['text_hover']};
}

.sc_layouts_row_type_compact .search_wrap .search_field::-webkit-input-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field::-webkit-input-placeholder {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .search_wrap .search_field::-moz-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field::-moz-placeholder {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .search_wrap .search_field:-ms-input-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field:-ms-input-placeholder {
	color: {$colors['text']};
}
*/

/* Row type: Normal */



/* Menu */
.sc_layouts_menu_nav > li ul {
	background-color: {$colors['text_hover']};	
}
.sc_layouts_menu_nav > li > a {
	color: {$colors['text_dark']};
}
.sc_layouts_menu_nav > li > a:hover,
.sc_layouts_menu_nav > li.sfHover > a {
	color: {$colors['text_link']} !important;
}
.sc_layouts_menu_nav > li.current-menu-item > a,
.sc_layouts_menu_nav > li.current-menu-parent > a,
.sc_layouts_menu_nav > li.current-menu-ancestor > a {
	color: {$colors['text_link']} !important;
}

/* Submenu */
.sc_layouts_menu_nav > li li > a {
	color: {$colors['inverse_light']} !important;
}
.sc_layouts_menu_nav > li li > a:hover,
.sc_layouts_menu_nav > li li.sfHover > a {
	color: {$colors['inverse_link']} !important;
}
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children > a:hover,
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children.sfHover > a {
	color: {$colors['alter_text']} !important;
	background-color: transparent;
}
.sc_layouts_menu_nav > li li[class*="icon-"]:before {
	color: {$colors['alter_hover']};
}
.sc_layouts_menu_nav > li li[class*="icon-"]:hover:before,
.sc_layouts_menu_nav > li li[class*="icon-"].shHover:before {
	color: {$colors['alter_hover']};
}
.sc_layouts_menu_nav > li li.current-menu-item > a,
.sc_layouts_menu_nav > li li.current-menu-parent > a,
.sc_layouts_menu_nav > li li.current-menu-ancestor > a {
	color:  {$colors['inverse_link']} !important;
}
.sc_layouts_menu_nav > li li.current-menu-item:before,
.sc_layouts_menu_nav > li li.current-menu-parent:before,
.sc_layouts_menu_nav > li li.current-menu-ancestor:before {
	color: {$colors['alter_link']};
}

/* Logo */
.sc_layouts_logo b {
	color: {$colors['text_dark']};
}
.sc_layouts_logo i {
	color: {$colors['text_link']};
}
.sc_layouts_logo_text {
	color: {$colors['text_link']};
}
.sc_layouts_logo:hover .logo_text {
	color: {$colors['text_dark']};
}
.logo_slogan {
	color: {$colors['text']};
}

/* Search style 'Expand' */
.search_style_expand.search_opened .search_submit {
	color: {$colors['accent2_hover']};
}
.search_style_expand .search_submit:hover,
.search_style_expand .search_submit:focus {
	color: {$colors['accent2_hover']};
}


/* Search style 'Fullscreen' */
.search_style_fullscreen.search_opened .search_form_wrap {
	background-color: {$colors['bg_color_09']};
}
.search_style_fullscreen.search_opened .search_form {
	border-color: {$colors['text_dark']};
}
.search_style_fullscreen.search_opened .search_close,
.search_style_fullscreen.search_opened .search_field,
.search_style_fullscreen.search_opened .search_submit {
	color: {$colors['text_dark']};
}
.search_style_fullscreen.search_opened .search_close:hover,
.search_style_fullscreen.search_opened .search_field:hover,
.search_style_fullscreen.search_opened .search_field:focus,
.search_style_fullscreen.search_opened .search_submit:hover,
.search_style_fullscreen.search_opened .search_submit:focus {
	color: {$colors['text']};
}
.search_style_fullscreen.search_opened .search_field::-webkit-input-placeholder {color:{$colors['text_light']}; opacity: 1;}
.search_style_fullscreen.search_opened .search_field::-moz-placeholder          {color:{$colors['text_light']}; opacity: 1;}/* Firefox 19+ */
.search_style_fullscreen.search_opened .search_field:-moz-placeholder           {color:{$colors['text_light']}; opacity: 1;}/* Firefox 18- */
.search_style_fullscreen.search_opened .search_field:-ms-input-placeholder      {color:{$colors['text_light']}; opacity: 1;}


.post_item_none_search .search_wrap .search_submit:hover, .post_item_none_archive .search_wrap .search_submit:hover{
	color: {$colors['text_link']};
	background-color: transparent;
}

/* Search results */
.search_wrap .search_results {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.search_wrap .search_results:after {
	background-color: {$colors['bg_color']};
	border-left-color: {$colors['bd_color']};
	border-top-color: {$colors['bd_color']};
}
.search_wrap .search_results .search_results_close {
	color: {$colors['text_light']};
}
.search_wrap .search_results .search_results_close:hover {
	color: {$colors['text_dark']};
}
.search_results.widget_area .post_item + .post_item {
	border-top-color: {$colors['bd_color']};
}


/* Mobile menu */
.scheme_self.menu_side_wrap .menu_side_button {
	color: {$colors['alter_dark']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color_07']};
}
.scheme_self.menu_side_wrap .menu_side_button:hover {
	color: {$colors['inverse_hover']};
	border-color: {$colors['alter_hover']};
	background-color: {$colors['alter_link']};
}
.menu_side_inner,
.menu_mobile_inner {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.menu_mobile_button {
	color: {$colors['text_dark']};
}
.menu_mobile_button:hover {
	color: {$colors['text_link']};
}
.menu_mobile_close:before,
.menu_mobile_close:after {
	border-color: {$colors['alter_dark']};
}
.menu_mobile_close:hover:before,
.menu_mobile_close:hover:after {
	border-color: {$colors['alter_link']};
}
.menu_mobile_inner a {
	color: {$colors['alter_dark']};
}
.menu_mobile_inner a:hover,
.menu_mobile_inner .current-menu-ancestor > a,
.menu_mobile_inner .current-menu-item > a {
	color: {$colors['alter_link']};
}
.menu_mobile_inner .search_mobile .search_submit {
	color: {$colors['input_light']};
}
.menu_mobile_inner .search_mobile .search_submit:focus,
.menu_mobile_inner .search_mobile .search_submit:hover {
	color: {$colors['input_dark']};
}

.menu_mobile_inner .social_item a {
	color: {$colors['alter_link']};
}
.menu_mobile_inner .social_item a:hover {
	color: {$colors['alter_dark']};
}

/* Page title and breadcrumbs */
.single .sc_layouts_title .post_categories a{
	color: {$colors['text_link']} !important;	
}
.single .sc_layouts_title .post_categories a:hover{
	color: {$colors['text_dark']} !important;	
}

.sc_layouts_title .sc_layouts_title_meta,
.sc_layouts_title .post_meta,
.sc_layouts_title .post_meta_item,
.sc_layouts_title a.post_meta_item,
.sc_layouts_title .post_meta_item a,
.sc_layouts_title .post_meta_item:before,
.sc_layouts_title .post_meta_item:hover:before,
.sc_layouts_title .post_meta_item.post_categories,
.sc_layouts_title .post_meta_item.post_categories a,
.sc_layouts_title .post_date a,
.sc_layouts_title .post_date:before,
.sc_layouts_title .post_info .post_info_item,
.sc_layouts_title .post_info .post_info_item a,
.sc_layouts_title .post_info_counters .post_counters_item,
.sc_layouts_title .post_counters .socials_share .socials_caption:before,
.sc_layouts_title .post_counters .socials_share .socials_caption:hover:before {
	color: {$colors['text']};
}
.sc_layouts_title .post_date a:hover,
.sc_layouts_title a.post_meta_item:hover,
.sc_layouts_title .post_meta_item a:hover,
.sc_layouts_title .post_meta_item.post_categories a:hover,
.sc_layouts_title .post_info .post_info_item a:hover,
.sc_layouts_title .post_info_counters .post_counters_item:hover {
	color: {$colors['text_light']};
}

.sc_layouts_title .sc_layouts_title_description {
	color: {$colors['text_dark']};
}
.sc_layouts_title_breadcrumbs {
	color: {$colors['text_light']};
}
.sc_layouts_title_breadcrumbs a {
	color: {$colors['text']} !important;
}
.sc_layouts_title_breadcrumbs a:hover {
	color: {$colors['text']} !important;
}


/* Tabs */
.luxury_wine_tabs .luxury_wine_tabs_titles li a {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}
.luxury_wine_tabs .luxury_wine_tabs_titles li a:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.luxury_wine_tabs .luxury_wine_tabs_titles li.ui-state-active a {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}

/* Post layouts */
.post_item {
	color: {$colors['text']};
	border-color: {$colors['bd_color']};
}
.post_meta,
.post_meta_item,
.post_meta_item a,
.post_meta_item:before,
.post_meta_item:hover:before,
.post_date a,
.post_date:before,
.post_info .post_info_item,
.post_info .post_info_item a,
.post_info_counters .post_counters_item,
.post_counters .socials_share .socials_caption:before,
.post_counters .socials_share .socials_caption:hover:before {
	color: {$colors['text_light']};
}
.post_date a:hover,
a.post_meta_item:hover,
.post_meta_item a:hover,
.post_info .post_info_item a:hover,
.post_info_counters .post_counters_item:hover {
	color: {$colors['text_dark']};
}
.post_item .post_title a:hover {
	color: {$colors['text_link']};
}
.post_item .more-link:hover, .gallery_preview_show .post_readmore:hover{
	color: {$colors['inverse_text']};	
	background-color: {$colors['text_link']};	
}
.post_meta_item.post_categories,
.post_meta_item.post_categories a {
	color: {$colors['text_link']};
}
.post_meta_item.post_categories a:hover {
	color: {$colors['text_hover']};
}

.post_meta_item .socials_share .social_items {
	background-color: {$colors['bg_color']};
}
.post_meta_item .social_items,
.post_meta_item .social_items:before {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_light']};
}

.post_layout_excerpt + .post_layout_excerpt {
	border-color: {$colors['bd_color']};
}
.post_layout_classic {
	border-color: {$colors['bd_color']};
}
.post_layout_classic .post_header .post_date a{
	color: {$colors['text_light']};
}
.post_layout_classic .post_header .post_date .day{
	color: {$colors['accent2_hover_05']};
}
.post_layout_classic .post_featured.without_thumb{
	background-color: {$colors['accent2_hover_05']};	
}
.scheme_self.gallery_preview:before {
	background-color: {$colors['bg_color']};
}
.scheme_self.gallery_preview {
	color: {$colors['text']};
}
.post_creative[class*="column-"] .post_item{
	background-color: {$colors['bg_color']};	
}
.post_creative .post_header .post_date .day {
	color: {$colors['accent2_hover_05']};
}


/* Post Formats */
.format-audio .post_featured .post_audio_author {
	color: {$colors['text_link']};
}
.format-audio .post_featured.without_thumb .post_audio {
	border-color: {$colors['bd_color']};
}
.format-audio .post_featured.without_thumb .post_audio_title,
.without_thumb .mejs-controls .mejs-currenttime,
.without_thumb .mejs-controls .mejs-duration {
	color: {$colors['text_dark']};
}

.mejs-container,
.mejs-container .mejs-controls,
.mejs-embed,
.mejs-embed body {
	background: {$colors['text_dark_07']};
}

.mejs-container .mejs-controls .mejs-button {
	color: {$colors['text_dark']};	
}

.mejs-controls .mejs-time-rail .mejs-time-current,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
	color: {$colors['inverse_link']};
	background: {$colors['alter_bd_color']};
}
.mejs-controls .mejs-time-rail .mejs-time-total,
.mejs-controls .mejs-time-rail .mejs-time-loaded,
.mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
	background: {$colors['alter_bd_color_04']};
}

.format-aside .post_content_inner {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}

.format-link .post_content_inner,
.format-status .post_content_inner {
	color: {$colors['text_dark']};
}

.format-chat p > b,
.format-chat p > strong {
	color: {$colors['text_dark']};
}
.post_layout_chess{
	background-color: {$colors['bg_color']};
}
.post_layout_chess .post_icon,
.post_layout_chess .post_tags a{
	color: {$colors['accent2_hover_05']};
}
.post_layout_chess .post_content_inner:after {
	background: linear-gradient(to top, {$colors['bg_color']} 0%, {$colors['bg_color_0']} 100%) no-repeat scroll right top / 100% 100% {$colors['bg_color_0']};
}
.post_layout_chess_1 .post_meta:before {
	background-color: {$colors['bd_color']};
}

/* Pagination */
.nav-links-old {
	color: {$colors['text_dark']};
}
.nav-links-old a:hover {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
}

.page_links > a,
.comments_pagination .page-numbers{
	color: {$colors['text_dark']};
	background-color: {$colors['input_bg_color']};
}
.nav-links .page-numbers {
	color: {$colors['text_dark']};
	border-color: {$colors['bd_color']};
}
.nav-links .page-numbers.current {
	color: {$colors['text_link']};
}
.page_links > a:hover,
.page_links > span:not(.page_links_title),
.comments_pagination a.page-numbers:hover,
.comments_pagination .page-numbers.current {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}

/* Single post */
.post_item_single .post_header .post_date {
	color: {$colors['text_light']};
}
.post_item_single .post_header .post_categories,
.post_item_single .post_header .post_categories a {
	color: {$colors['text_link']};
}
.post_item_single .post_header .post_meta_item,
.post_item_single .post_header .post_meta_item:before,
.post_item_single .post_header .post_meta_item:hover:before,
.post_item_single .post_header .post_meta_item a,
.post_item_single .post_header .post_meta_item a:before,
.post_item_single .post_header .post_meta_item a:hover:before,
.post_item_single .post_header .post_meta_item .socials_caption,
.post_item_single .post_header .post_meta_item .socials_caption:before,
.post_item_single .post_header .post_edit a {
	color: {$colors['text_light']};
}
.post_item_single .post_meta_item:hover,
.post_item_single .post_meta_item > a:hover,
.post_item_single .post_meta_item .socials_caption:hover,
.post_item_single .post_edit a:hover {
	color: {$colors['text_hover']};
}
.post_item_single .post_content .post_meta_label,
.post_item_single .post_content .post_meta_item:hover .post_meta_label {
	color: {$colors['text_dark']};
}
.post_item_single .post_content .post_tags,
.post_item_single .post_content .post_tags a {
	color: {$colors['text_dark']};
	border-color: {$colors['bd_color']};
}
.post_item_single .post_content .post_tags a:hover {
	color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}

.post-password-form input[type="submit"] {
	border-color: {$colors['text_dark']};
}
.post-password-form input[type="submit"]:hover,
.post-password-form input[type="submit"]:focus {
	color: {$colors['bg_color']};
}

/* Single post navi */
.nav-links-single .nav-links {
	border-color: {$colors['bd_color']};
}
.nav-links-single .nav-links a .meta-nav {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a .post_date {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a:hover .meta-nav,
.nav-links-single .nav-links a:hover .post_date {
	color: {$colors['text_dark']};
}
.nav-links-single .nav-links a:hover .post-title {
	color: {$colors['text_link']};
}

/* Author info */
.scheme_self.author_info {
	color: {$colors['text']};
	background-color: {$colors['alter_bg_color']};
}
.scheme_self.author_info .author_subtitle {
	color: {$colors['text_link']};
}
.scheme_self.author_info .author_title {
	color: {$colors['accent2']};
}
.scheme_self.author_info a {
	color: {$colors['text_dark']};
}
.scheme_self.author_info a:hover {
	color: {$colors['text_link']};
}

/* Related posts */
.related_wrap {
	border-color: {$colors['bd_color']};
}
.related_wrap .post_date a{
	color: {$colors['text_light']};
}
.related_wrap .post_date .day{
	color: {$colors['accent2_hover_05']};
}
.related_wrap .related_item_style_1 .post_header {
	background-color: {$colors['bg_color_07']};
}
.related_wrap .related_item_style_1:hover .post_header {
	background-color: {$colors['bg_color']};
}
.related_wrap .related_item_style_1 .post_date a {
	color: {$colors['text']};
}
.related_wrap .related_item_style_1:hover .post_date a {
	color: {$colors['text_light']};
}
.related_wrap .related_item_style_1:hover .post_date a:hover {
	color: {$colors['text_dark']};
}

/* Comments */
.comments_list_wrap,
.comments_list_wrap > ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap li + li,
.comments_list_wrap li ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap .comment_reply a,
.comments_list_wrap .comment_posted{
	color: {$colors['text_light']};	
}
.comments_list_wrap .comment_info {
	color: {$colors['text_dark']};
}
.comments_list_wrap .comment_counters a {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:before {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:hover:before,
.comments_list_wrap .comment_counters a:hover {
	color: {$colors['text_hover']};
}
.comments_list_wrap .comment_text {
	color: {$colors['text']};
}
.comments_list_wrap .comment_reply a:hover {
	color: {$colors['text_link']};
}
.comments_form_wrap {
	border-color: {$colors['bd_color']};
}
.comments_wrap .comments_field label,
.comments_wrap .comments_notes {
	color: {$colors['text_light']};
}



/* Page 404 */
.post_item_404 .page_title {
	color: {$colors['text_light']};
}
.post_item_404 .page_description {
	color: {$colors['text_link']};
}
.post_item_404 .go_home {
	border-color: {$colors['text_dark']};
}

/* Sidebar */
.scheme_self.sidebar .sidebar_inner {
	background-color: {$colors['alter_bg_color']};
	color: {$colors['alter_text']};
}
.sidebar_inner .widget + .widget {
	border-color: {$colors['bd_color']};
}
.scheme_self.sidebar .widget + .widget {
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.sidebar h1, .scheme_self.sidebar h2, .scheme_self.sidebar h3, .scheme_self.sidebar h4, .scheme_self.sidebar h5, .scheme_self.sidebar h6,
.scheme_self.sidebar h1 a, .scheme_self.sidebar h2 a, .scheme_self.sidebar h3 a, .scheme_self.sidebar h4 a, .scheme_self.sidebar h5 a, .scheme_self.sidebar h6 a {
	color: {$colors['alter_dark']};
}
.scheme_self.sidebar h1 a:hover, .scheme_self.sidebar h2 a:hover, .scheme_self.sidebar h3 a:hover, .scheme_self.sidebar h4 a:hover, .scheme_self.sidebar h5 a:hover, .scheme_self.sidebar h6 a:hover {
	color: {$colors['alter_link']};
}


/* Widgets */
.widget li a {
	color: {$colors['alter_text']}; 
}
.widget li a:hover {
	color: {$colors['alter_hover']}; 
}
.widget .post_item{
	border-color: {$colors['bd_color']}; 
}
.widget .post_item .post_title a{
	color: {$colors['accent2']}; 
}
.widget .post_item .post_title a:hover{
	color: {$colors['alter_hover']}; 
}
.widget post_info .post_info_item a{
	color: {$colors['alter_light']}; 
}
.scheme_self.sidebar li:before {
	background-color: {$colors['alter_link']};
}
.scheme_self.sidebar a {
	color: {$colors['alter_link']};
}
.scheme_self.sidebar a:hover {
	color: {$colors['alter_hover']};
}
.scheme_self.sidebar li > a,
.scheme_self.sidebar .post_title > a {
	color: {$colors['alter_dark']};
}
.scheme_self.sidebar li > a:hover,
.scheme_self.sidebar .post_title > a:hover {
	color: {$colors['alter_link']};
}

/* Archive */
.scheme_self.sidebar .widget_archive li {
	color: {$colors['alter_dark']};
}

/* Calendar */
.widget_calendar caption,
.widget_calendar tbody td a,
.widget_calendar th {
	color: {$colors['text_dark']};
}
.scheme_self.sidebar .widget_calendar caption,
.scheme_self.sidebar .widget_calendar tbody td a,
.scheme_self.sidebar .widget_calendar th {
	color: {$colors['alter_dark']};
}
.widget_calendar tbody td {
	color: {$colors['text']} !important;
}
.scheme_self.sidebar .widget_calendar tbody td {
	color: {$colors['alter_text']} !important;
}
.widget_calendar tbody td a:hover {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar tbody td a:hover {
	color: {$colors['alter_link']};
}
.widget_calendar tbody td a:after {
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar tbody td a:after {
	background-color: {$colors['alter_link']};
}
.widget_calendar td#today {
	color: {$colors['inverse_text']} !important;
}
.widget_calendar td#today a {
	color: {$colors['inverse_link']};
}
.widget_calendar td#today a:hover {
	color: {$colors['inverse_hover']};
}
.widget_calendar td#today:before {
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar td#today:before {
	background-color: {$colors['alter_link']};
}
.widget_calendar td#today a:after {
	background-color: {$colors['inverse_link']};
}
.widget_calendar td#today a:hover:after {
	background-color: {$colors['inverse_hover']};
}
.widget_calendar #prev a,
.widget_calendar #next a {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar #prev a,
.scheme_self.sidebar .widget_calendar #next a {
	color: {$colors['alter_link']};
}
.widget_calendar #prev a:hover,
.widget_calendar #next a:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_calendar #prev a:hover,
.scheme_self.sidebar .widget_calendar #next a:hover {
	color: {$colors['alter_hover']};
}
.widget_calendar td#prev a:before,
.widget_calendar td#next a:before {
	background-color: {$colors['bg_color']};
}
.scheme_self.sidebar .widget_calendar td#prev a:before,
.scheme_self.sidebar .widget_calendar td#next a:before {
	background-color: {$colors['alter_bg_color']};
}

/* Categories */
.widget_categories li {
	color: {$colors['text_dark']};
}
.scheme_self.sidebar .widget_categories li {
	color: {$colors['alter_dark']};
}

/* Tag cloud */
.widget_product_tag_cloud a.sc_button_hover_style_alterbd,
.widget_tag_cloud a.sc_button_hover_style_alterbd {
	color: {$colors['accent2']} !important;
	border-color: {$colors['bd_color']};
	background: linear-gradient(to right, {$colors['text_link']} 50%, transparent 50%) no-repeat scroll right bottom / 210% 100% transparent !important;
}
.scheme_self.sidebar .widget_product_tag_cloud a.sc_button_hover_style_alterbd,
.scheme_self.sidebar .widget_tag_cloud a.sc_button_hover_style_alterbd {
	color: {$colors['accent2']} !important;
	border-color: {$colors['bd_color']};
	background: linear-gradient(to right, {$colors['text_link']} 50%, transparent 50%) no-repeat scroll right bottom / 210% 100% transparent !important;
}
.widget_product_tag_cloud a.sc_button_hover_style_alterbd:hover,
.widget_tag_cloud a.sc_button_hover_style_alterbd:hover {
	color: {$colors['inverse_text']} !important;
	border-color: {$colors['text_link']};
	background-position: left bottom !important;
}
.scheme_self.sidebar .widget_product_tag_cloud a.sc_button_hover_style_alterbd:hover,
.scheme_self.sidebar .widget_tag_cloud a.sc_button_hover_style_alterbd:hover {
	color: {$colors['inverse_text']} !important;
	border-color: {$colors['text_link']};
    background-position: left bottom !important;
}

/* RSS */
.widget_rss .widget_title a:first-child {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child {
	color: {$colors['alter_link']};
}
.widget_rss .widget_title a:first-child:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child:hover {
	color: {$colors['alter_hover']};
}
.widget_rss .rss-date {
	color: {$colors['text_light']};
}
.scheme_self.sidebar .widget_rss .rss-date {
	color: {$colors['alter_light']};
}

/* Footer */
.scheme_self.footer_wrap {
	background-color: {$colors['alter_bg_color']};
	color: {$colors['alter_text']};
}
.scheme_self.footer_wrap .widget,
.scheme_self.footer_wrap .sc_content .wpb_column {
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.footer_wrap h1, .scheme_self.footer_wrap h2, .scheme_self.footer_wrap h3, .scheme_self.footer_wrap h4, .scheme_self.footer_wrap h5, .scheme_self.footer_wrap h6,
.scheme_self.footer_wrap h1 a, .scheme_self.footer_wrap h2 a, .scheme_self.footer_wrap h3 a, .scheme_self.footer_wrap h4 a, .scheme_self.footer_wrap h5 a, .scheme_self.footer_wrap h6 a {
	color: {$colors['alter_dark']};
}
.scheme_self.footer_wrap h1 a:hover, .scheme_self.footer_wrap h2 a:hover, .scheme_self.footer_wrap h3 a:hover, .scheme_self.footer_wrap h4 a:hover, .scheme_self.footer_wrap h5 a:hover, .scheme_self.footer_wrap h6 a:hover {
	color: {$colors['alter_link']};
}
.scheme_self.footer_wrap a {
	color: {$colors['alter_dark']};
}
.scheme_self.footer_wrap a:hover {
	color: {$colors['alter_link']};
}
.scheme_self.footer_wrap .socials_wrap .social_item a {
	color: {$colors['accent2_hover_05']};
	border-color: {$colors['accent2_hover_05']};
	background-color: {$colors['bg_color']};
}
.scheme_self.footer_wrap .socials_wrap .social_item a:hover {
	color: {$colors['inverse_text']};
	border-color: {$colors['simple_bg_hover']} !important;
	background-color: {$colors['simple_bg_hover']} !important;
}
.footer_logo_inner {
	border-color: {$colors['alter_bd_color']};
}
.footer_logo_inner:after {
	background-color: {$colors['alter_text']};
}
.footer_copyright_inner .footer_socials_inner .social_item .social_icons {
	color: {$colors['alter_hover']};
}
.footer_copyright_inner .footer_socials_inner .social_item .social_icons:hover {
	color: {$colors['alter_dark']};
	background-color: transparent !important;
}
.menu_footer_nav_area ul li a {
	color: {$colors['alter_dark']};
}
.menu_footer_nav_area ul li a:hover {
	color: {$colors['alter_link']};
}
.menu_footer_nav_area ul li+li:before {
	border-color: {$colors['alter_light']};
}

.footer_copyright_inner {
	background-color: {$colors['alter_bg_hover']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_dark']};
}
.footer_copyright_inner a {
	color: {$colors['text_dark']};
}
.footer_copyright_inner a:hover {
	color: {$colors['text_link']};
}
.footer_copyright_inner .copyright_text {
	color: {$colors['text_light']};
}

/* Buttons */
.theme_button,
.comments_wrap .form-submit input[type="submit"] {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_link']} !important;
}
.theme_button:hover,
.comments_wrap .form-submit input[type="submit"]:hover,
.comments_wrap .form-submit input[type="submit"]:focus {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_link_blend']} !important;
}
.comments_wrap .comments_field input, 
.comments_wrap .comments_field textarea{
	background-color: {$colors['input_bg_hover']} !important;
	border-color: {$colors['input_bd_hover']} !important;
}
.comments_wrap .comments_field input:focus, 
.comments_wrap .comments_field textarea:focus{
	background-color: {$colors['input_bg_color']} !important;
	border-color: {$colors['input_bd_color']} !important;
}
.format-video .post_featured.with_thumb .post_video_hover {
	color: {$colors['inverse_text']};
	border-color: {$colors['inverse_text']};
}
.format-video .post_featured.with_thumb .post_video_hover:hover {
	color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}

.theme_scroll_down:hover {
	color: {$colors['text_link']};
}

/* Third-party plugins */

.mfp-bg {
	background-color: {$colors['bg_color_07']};
}
.mfp-image-holder .mfp-close,
.mfp-iframe-holder .mfp-close,
.mfp-close-btn-in .mfp-close {
	color: {$colors['text_dark']};
	background-color: transparent;
}
.mfp-image-holder .mfp-close:hover,
.mfp-iframe-holder .mfp-close:hover,
.mfp-close-btn-in .mfp-close:hover {
	color: {$colors['text_link']};
}
.minimal-light .esg-grid .esg-filterbutton {
	color: {$colors['text_light']};	
}
.minimal-light .esg-grid .esg-filterbutton + .esg-filterbutton:before {
	background-color: {$colors['bd_color']};	
}
.minimal-light .esg-grid .esg-filterbutton span:before{
	color: {$colors['accent2_hover_05']};	
}
.minimal-light .esg-grid .esg-filterbutton:hover,
.minimal-light .esg-grid .esg-filterbutton.selected {
	color: {$colors['text_link']};	
}
.minimal-light .esg-grid .esg-filterbutton:hover span:before{
	color: {$colors['text_link']};	
}
/*
table td{
	color: #ddd;
}
.bg_color{
	background-color: {$colors['bg_color']};		
}
.alter_bg_color{
	background-color: {$colors['alter_bg_color']};		
}
.input_bg_color{
	background-color: {$colors['input_bg_color']};		
}
.alter_bg_hover{
	background-color: {$colors['alter_bg_hover']};		
}
.input_bg_hover{
	background-color: {$colors['input_bg_hover']};		
}
.bd_color{
	background-color: {$colors['bd_color']};		
}

.alter_bd_color{
	background-color: {$colors['alter_bd_color']};		
}
.input_bd_color{
	background-color: {$colors['input_bd_color']};		
}
.alter_bd_hover{
	background-color: {$colors['alter_bd_hover']};		
}
.input_bd_hover{
	background-color: {$colors['input_bd_hover']};		
}
.text{
	background-color: {$colors['text']};		
}
.alter_text{
	background-color: {$colors['alter_text']};		
}

.input_text{
	background-color: {$colors['input_text']};		
}
.text_light{
	background-color: {$colors['text_light']};		
}
.alter_light{
	background-color: {$colors['alter_light']};		
}
.input_light{
	background-color: {$colors['input_light']};		
}
.text_dark{
	background-color: {$colors['text_dark']};		
}
.alter_dark{
	background-color: {$colors['alter_dark']};		
}

.input_dark{
	background-color: {$colors['input_dark']};		
}
.text_link{
	background-color: {$colors['text_link']};		
}
.alter_link{
	background-color: {$colors['alter_link']};		
}
.text_hover{
	background-color: {$colors['text_hover']};		
}
.alter_hover{
	background-color: {$colors['alter_hover']};		
}
.accent2{
	background-color: {$colors['accent2']};		
}
.accent2_hover{
	background-color: {$colors['accent2_hover']};		
}
.button_bg_color{
	background-color: {$colors['button_bg_color']};		
}
.button_bg_hover{
	background-color: {$colors['button_bg_hover']};		
}*/
CSS;
				
					$rez = apply_filters('luxury_wine_filter_get_css', $rez, $colors, false, $scheme);
					$css['colors'] .= $rez['colors'];
				}
			}
		}
				
		$css_str = (!empty($css['fonts']) ? $css['fonts'] : '')
				. (!empty($css['colors']) ? $css['colors'] : '');
		return apply_filters( 'luxury_wine_filter_prepare_css', $css_str, $remove_spaces );
	}
}
?>
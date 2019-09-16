/**
 * Shortcode Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

/* global jQuery:false, TRX_ADDONS_STORAGE:false */

// Init handlers
jQuery('.sc_blogger_creative').each(function() {
	"use strict";
	var count = jQuery(this).find('[class*="trx_addons_column-"]').length;
	jQuery(this).find('[class*="trx_addons_column-"]').each(function() {
		"use strict";
		var number = jQuery(this).index() + 1;
		var grid = new Array(
					new Array('full'),
					new Array('full', 'full'),
					new Array('big', 'medium', 'big right'),
					new Array('big', 'medium', 'big right', 'full'),
					new Array('big', 'medium', 'big right', 'full', 'full'),
					new Array('big', 'medium', 'big right', 'big r', 'medium l', 'big right r'),
					new Array('big', 'medium', 'big right', 'big r', 'medium l', 'big right r', 'full'),
					new Array('big', 'medium', 'big right', 'big r', 'medium l', 'big right r', 'full', 'full'),
					new Array('big', 'medium', 'big right', 'big r', 'medium l', 'big right r', 'big', 'medium', 'big right')
				);
		if(count > 9) count = 9;
		var thumb_slug = grid[count-number >= 9 ? 9 : (count-1)%9][(number-1)%9];
		jQuery(this).addClass('post_size_' + thumb_slug);
		if(thumb_slug == 'medium'){
			jQuery(this).find('.post_featured').appendTo(jQuery(this).find('.sc_blogger_item'));
		}
	});
});

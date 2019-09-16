/* global jQuery:false */
/* global LUXURY_WINE_STORAGE:false */

jQuery(document).on('action.ready_luxury-wine', luxury_wine_js_composer_init);
jQuery(document).on('action.init_shortcodes', luxury_wine_js_composer_init);
jQuery(document).on('action.init_hidden_elements', luxury_wine_js_composer_init);

function luxury_wine_js_composer_init(e, container) {
	"use strict";
	if (arguments.length < 2) var container = jQuery('body');
	if (container===undefined || container.length === undefined || container.length == 0) return;

	container.find('.vc_message_box_closeable:not(.inited)').addClass('inited').on('click', function(e) {
		"use strict";
		jQuery(this).fadeOut();
		e.preventDefault();
		return false;
	});
}
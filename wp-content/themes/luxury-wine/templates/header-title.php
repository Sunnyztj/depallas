<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

// Page (category, tag, archive, author) title

if ( luxury_wine_need_page_title() ) {
	luxury_wine_sc_layouts_showed('title', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								luxury_wine_show_post_meta(array(
									'date' => false,
									'categories' => true,
									'seo' => false,
									'share' => false,
									'counters' => ''
									)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$luxury_wine_blog_title = luxury_wine_get_blog_title();
							$luxury_wine_blog_title_text = $luxury_wine_blog_title_class = $luxury_wine_blog_title_link = $luxury_wine_blog_title_link_text = '';
							if (is_array($luxury_wine_blog_title)) {
								$luxury_wine_blog_title_text = $luxury_wine_blog_title['text'];
								$luxury_wine_blog_title_class = !empty($luxury_wine_blog_title['class']) ? ' '.$luxury_wine_blog_title['class'] : '';
								$luxury_wine_blog_title_link = !empty($luxury_wine_blog_title['link']) ? $luxury_wine_blog_title['link'] : '';
								$luxury_wine_blog_title_link_text = !empty($luxury_wine_blog_title['link_text']) ? $luxury_wine_blog_title['link_text'] : '';
							} else
								$luxury_wine_blog_title_text = $luxury_wine_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($luxury_wine_blog_title_class); ?>"><?php
								$luxury_wine_top_icon = luxury_wine_get_category_icon();
								if (!empty($luxury_wine_top_icon)) {
									$luxury_wine_attr = luxury_wine_getimagesize($luxury_wine_top_icon);
									?><img src="<?php echo esc_url($luxury_wine_top_icon); ?>" alt="<?php echo esc_html(basename($luxury_wine_top_icon)); ?>" <?php if (!empty($luxury_wine_attr[3])) luxury_wine_show_layout($luxury_wine_attr[3]);?>><?php
								}
								echo wp_kses_data($luxury_wine_blog_title_text);
							?></h1>
							<?php
							if (!empty($luxury_wine_blog_title_link) && !empty($luxury_wine_blog_title_link_text)) {
								?><a href="<?php echo esc_url($luxury_wine_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($luxury_wine_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								luxury_wine_show_post_meta(array(
									'date' => true,
									'author' => true,
									'categories' => false,
									'seo' => false,
									'share' => false,
									'counters' => 'comments'
									)
								);
							?></div><?php
						}
						else{
							// Breadcrumbs
							?><div class="sc_layouts_title_breadcrumbs"><?php
								do_action( 'luxury_wine_action_breadcrumbs');
							?></div><?php
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
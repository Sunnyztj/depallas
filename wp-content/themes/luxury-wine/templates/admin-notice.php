<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0.1
 */
?>
<div class="update-nag" id="luxury_wine_admin_notice">
	<h3 class="luxury_wine_notice_title"><?php echo sprintf(esc_html__('Welcome to %s', 'luxury-wine'), wp_get_theme()->name); ?></h3>
	<?php
	if (!luxury_wine_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'luxury-wine')); ?></p><?php
	}
	?><p><?php
		if (luxury_wine_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'luxury-wine'); ?></a>
			<?php
		}
		if (function_exists('luxury_wine_exists_trx_addons') && luxury_wine_exists_trx_addons()) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'luxury-wine'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'luxury-wine'); ?></a>
        <a href="#" class="button luxury_wine_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'luxury-wine'); ?></a>
	</p>
</div>
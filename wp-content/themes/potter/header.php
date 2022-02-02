<?php
/**
 * Theme Header.
 *
 * See also inc/template-parts/header.php.
 *
 * @package Potter
 */

defined('ABSPATH') || die("Can't access directly");

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php potter_body_schema_markup(); ?>>
	<a class="screen-reader-text skip-link" href="#content" title="<?php echo esc_attr__('Skip to content', 'potter'); ?>"><?php esc_html_e('Skip to content', 'potter'); ?></a>
	<?php do_action('wp_body_open'); ?>
		<?php do_action('potter_body_open'); ?>
		<?php do_action('potter_before_header'); ?>
			<div id="container" class="hfeed potter-page">
				<?php do_action('potter_before_header_open'); ?>
					<?php do_action('potter_header'); ?>
						<?php do_action('potter_after_header'); ?>

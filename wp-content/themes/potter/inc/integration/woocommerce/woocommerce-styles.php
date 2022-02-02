<?php
/**
 * Dynamic WooCommerce CSS.
 *
 * Holds Customizer WooCommerce CSS styles.
 *
 * @package Potter
 * @subpackage Integration/WooCommerce
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

function potter_do_woocommerce_customizer_css() {

	$breakpoint_mobile = get_theme_mod('responsive_breakpoint_mobile', '480');
	$breakpoint_medium = get_theme_mod('responsive_breakpoint_tablet', '768');
	$breakpoint_desktop = get_theme_mod('responsive_breakpoint_desktop', '1024');

	// Notices.
	$page_accent_color                = get_theme_mod( 'page_accent_color' );
	$woocommerce_store_notice_color   = get_theme_mod( 'woocommerce_store_notice_color' );
	$woocommerce_info_notice_color    = get_theme_mod( 'woocommerce_info_notice_color' );
	$woocommerce_message_notice_color = get_theme_mod( 'woocommerce_message_notice_color' );
	$woocommerce_error_notice_color   = get_theme_mod( 'woocommerce_error_notice_color' );

	if ( $woocommerce_store_notice_color ) {

		echo 'p.demo_store, .woocommerce-store-notice {';
		echo sprintf( 'background-color: %s !important;', esc_attr( $woocommerce_store_notice_color ) );
			echo esc_attr($shop_title_bar_background_color);
		echo '}';

	} elseif ( $page_accent_color ) {

		echo 'p.demo_store, .woocommerce-store-notice {';
		echo sprintf( 'background-color: %s !important;', esc_attr( $page_accent_color ) );
		echo '}';

	}

	if ( $woocommerce_info_notice_color ) {

		echo '.woocommerce-info a {';
		echo sprintf( 'color: %s;', esc_attr( $woocommerce_info_notice_color ) );
		echo '}';
		echo '.woocommerce-info:before {';
		echo sprintf( 'color: %s !important;', esc_attr( $woocommerce_info_notice_color ) );
		echo '}';

		echo '.woocommerce-info a:hover {';
		echo 'opacity: .8;';
		echo '}';

		echo '.woocommerce-info {';
		echo sprintf( 'border-top-color: %s !important;', esc_attr( $woocommerce_info_notice_color ) );
		echo '}';

	} elseif ( $page_accent_color ) {

		echo '.woocommerce-info a {';
		echo sprintf( 'color: %s;', esc_attr( $page_accent_color ) );
		echo '}';
		echo '.woocommerce-info:before {';
		echo sprintf( 'color: %s !important;', esc_attr( $page_accent_color ) );
		echo '}';

		echo '.woocommerce-info a:hover {';
		echo 'opacity: .8;';
		echo '}';

		echo '.woocommerce-info {';
		echo sprintf( 'border-top-color: %s !important;', esc_attr( $page_accent_color ) );
		echo '}';

	}

	if ( $woocommerce_message_notice_color ) {

		echo '.woocommerce-message:before, .woocommerce-message a {';
		echo sprintf( 'color: %s !important;', esc_attr( $woocommerce_message_notice_color ) );
		echo '}';

		echo '.woocommerce-message a:hover {';
		echo 'opacity: .8;';
		echo '}';

		echo '.woocommerce-message {';
		echo sprintf( 'border-top-color: %s;', esc_attr( $woocommerce_message_notice_color ) );
		echo '}';

	}

	if ( $woocommerce_error_notice_color ) {

		echo '.woocommerce-error:before, .woocommerce-error a {';
		echo sprintf( 'color: %s;', esc_attr( $woocommerce_error_notice_color ) );
		echo '}';

		echo '.woocommerce-error a:hover {';
		echo 'opacity: .8;';
		echo '}';

		echo '.woocommerce-error {';
		echo sprintf( 'border-top-color: %s;', esc_attr( $woocommerce_error_notice_color ) );
		echo '}';

	}

	// Menu item desktop.
	$woocommerce_menu_item_desktop       = get_theme_mod( 'woocommerce_menu_item_desktop' );
	$woocommerce_menu_item_desktop_color = get_theme_mod( 'woocommerce_menu_item_desktop_color' );
	$woocommerce_menu_item_icon_color = get_theme_mod( 'woocommerce_menu_item_icon_color' );
		$woocommerce_menu_item_icon_sticky_color = get_theme_mod( 'woocommerce_menu_item_icon_sticky_color' );
		$woocommerce_menu_item_icon_transparent_color = get_theme_mod( 'woocommerce_menu_item_icon_transparent_color' );


		$cart_icon_size = get_theme_mod( 'cart_icon_size' );
	$menu_font_color                     = get_theme_mod( 'menu_font_color' );


	if ( 'hide' !== $woocommerce_menu_item_desktop ) {
		if ( $cart_icon_size ) {
			echo '.potter-woo-menu-item a i {';
	    echo sprintf('font-size: %spx;', esc_attr($cart_icon_size ));
	    echo '}';
		}

		if ( $woocommerce_menu_item_desktop_color ) {

			echo '.potter-menu .potter-woo-menu-item .potter-woo-menu-item-count, .potter-woo-menu-item .potter-woo-menu-item-count {';
			echo sprintf( 'background: %s;', esc_attr( $woocommerce_menu_item_desktop_color ) );
			echo '}';
			echo '.potter-woo-menu-item a:hover {';
			echo sprintf( 'color: %s;', esc_attr( $woocommerce_menu_item_desktop_color ) );
			echo '}';



		} elseif ( $page_accent_color ) {

			echo '.potter-menu .potter-woo-menu-item .potter-woo-menu-item-count, .potter-woo-menu-item .potter-woo-menu-item-count {';
			echo sprintf( 'background: %s;', esc_attr( $page_accent_color ) );
			echo '}';
		}

		if ( $woocommerce_menu_item_icon_color ) {
			echo '.potter-menu .potter-woo-menu-item a i {';
			echo sprintf( 'color: %s;', esc_attr( $woocommerce_menu_item_icon_color ) );
			echo '}';
		}
		if ($woocommerce_menu_item_icon_sticky_color) {
			echo '.stickynav .potter-menu .potter-woo-menu-item a i {';
			echo sprintf( 'color: %s !important;', esc_attr( $woocommerce_menu_item_icon_sticky_color ) );
			echo '}';
		}

		if ($woocommerce_menu_item_icon_transparent_color) {
			echo '.transparent-header .potter-menu .potter-woo-menu-item a i {';
			echo sprintf( 'color: %s;', esc_attr( $woocommerce_menu_item_icon_transparent_color ) );
			echo '}';
		}

	}
//dropdown-cartsetting
$woocommerce_menu_item_link = get_theme_mod( 'woocommerce_menu_item_link', 'cartpage' );
$woocommerce_menu_dropdowncart_bgcolor = get_theme_mod( 'woocommerce_menu_dropdowncart_bgcolor');
$woocommerce_menu_dropdowncart_fontcolor = get_theme_mod( 'woocommerce_menu_dropdowncart_fontcolor');
$woocommerce_menu_dropdowncart_acentcolor = get_theme_mod( 'woocommerce_menu_dropdowncart_acentcolor');
$woocommerce_menu_dropdowncart_hovercolor = get_theme_mod( 'woocommerce_menu_dropdowncart_hovercolor');


if ('dropdowncart' ===$woocommerce_menu_item_link) {
	if ($woocommerce_menu_dropdowncart_bgcolor) {
		echo '.potter-woo-sub-menu {';
		echo sprintf( 'background: %s !important;', esc_attr( $woocommerce_menu_dropdowncart_bgcolor) );
		echo '}';
	}
	if ($woocommerce_menu_dropdowncart_fontcolor) {
		echo '.potter-woo-sub-menu-table-wrap, .potter-woo-sub-menu-summary-wrap {';
		echo sprintf( 'color: %s !important;', esc_attr( $woocommerce_menu_dropdowncart_fontcolor) );
		echo '}';
	}
	if ($woocommerce_menu_dropdowncart_acentcolor) {
		echo '.potter-woo-sub-menu-table-wrap a {';
		echo sprintf( 'color: %s !important;', esc_attr( $woocommerce_menu_dropdowncart_acentcolor) );
		echo '}';
	}
	if ($woocommerce_menu_dropdowncart_hovercolor) {
		echo '.potter-woo-sub-menu-table-wrap a:hover {';
		echo sprintf( 'color: %s !important;', esc_attr( $woocommerce_menu_dropdowncart_hovercolor) );
		echo '}';
	}
}

//cart off-canvas setting
$woocommerce_offcanvas_bgcolor = get_theme_mod( 'woocommerce_offcanvas_bgcolor');
$woocommerce_offcanvas_fontcolor = get_theme_mod( 'woocommerce_offcanvas_fontcolor');
$woocommerce_offcanvas_acentcolor = get_theme_mod( 'woocommerce_offcanvas_acentcolor');
$woocommerce_offcanvas_hovercolor = get_theme_mod( 'woocommerce_offcanvas_hovercolor');
$woocommerce_offcanvas_closecolor = get_theme_mod( 'woocommerce_offcanvas_closecolor');


if ('offcanvas' ===$woocommerce_menu_item_link) {
	if ($woocommerce_offcanvas_bgcolor) {
		echo '.offminicart {';
		echo sprintf( 'background: %s !important;', esc_attr( $woocommerce_offcanvas_bgcolor) );
		echo '}';
	}

	if ($woocommerce_offcanvas_fontcolor) {
		echo '.offminicart .mini_cart_item, .offminicart .woocommerce-mini-cart__total {';
		echo sprintf( 'color: %s !important;', esc_attr( $woocommerce_offcanvas_fontcolor) );
		echo '}';
	}
	if ($woocommerce_offcanvas_acentcolor) {
		echo '.offminicart .mini_cart_item a {';
		echo sprintf( 'color: %s !important;', esc_attr( $woocommerce_offcanvas_acentcolor) );
		echo '}';
	}

	if ($woocommerce_offcanvas_hovercolor) {
		echo '.offminicart .mini_cart_item a:hover {';
		echo sprintf( 'color: %s !important;', esc_attr( $woocommerce_offcanvas_hovercolor) );
		echo '}';
	}
	if ($woocommerce_offcanvas_closecolor) {
		echo '.offminicart .potter-close {';
		echo sprintf( 'color: %s !important;', esc_attr( $woocommerce_offcanvas_closecolor) );
		echo '}';
	}

}


	// Menu item mobile.
	$woocommerce_menu_item_mobile       = get_theme_mod( 'woocommerce_menu_item_mobile' );
	$woocommerce_menu_item_mobile_color = get_theme_mod( 'woocommerce_menu_item_mobile_color' );
	$mobile_menu_font_color             = get_theme_mod( 'mobile_menu_font_color' );

	if ( 'hide' !== $woocommerce_menu_item_mobile ) {

		if ( $woocommerce_menu_item_mobile_color ) {

			echo '.potter-mobile-nav-wrapper .potter-woo-menu-item .potter-woo-menu-item-count, .potter-woo-menu-item .potter-woo-menu-item-count {';
			echo sprintf( 'background: %s;', esc_attr( $woocommerce_menu_item_mobile_color ) );
			echo '}';



		} elseif ( $woocommerce_menu_item_desktop_color ) {

			echo '.potter-mobile-nav-wrapper .potter-woo-menu-item .potter-woo-menu-item-count, .potter-woo-menu-item .potter-woo-menu-item-count {';
			echo sprintf( 'background: %s;', esc_attr( $woocommerce_menu_item_desktop_color ) );
			echo '}';



		} elseif ( $mobile_menu_font_color ) {

			echo '.potter-mobile-nav-wrapper .potter-woo-menu-item .potter-woo-menu-item-count {';
			echo sprintf( 'background: %s;', esc_attr( $mobile_menu_font_color ) );
			echo '}';



		} elseif ( $menu_font_color ) {

			echo '.potter-mobile-nav-wrapper .potter-woo-menu-item .potter-woo-menu-item-count {';
			echo sprintf( 'background: %s;', esc_attr( $menu_font_color ) );
			echo '}';



		} elseif ( $page_accent_color ) {

			echo '.potter-mobile-nav-wrapper .potter-woo-menu-item .potter-woo-menu-item-count {';
			echo sprintf( 'background: %s;', esc_attr( $page_accent_color ) );
			echo '}';



		}

	}

	// Buttons.
	$button_border_width             = get_theme_mod( 'button_border_width' );
	$button_primary_border_color     = get_theme_mod( 'button_primary_border_color' );
	$button_primary_border_color_alt = get_theme_mod( 'button_primary_border_color_alt' );
	$button_primary_bg_color         = get_theme_mod( 'button_primary_bg_color' );
	$button_primary_text_color       = get_theme_mod( 'button_primary_text_color' );
	$button_border_radius            = get_theme_mod( 'button_border_radius' );
	$button_primary_bg_color_alt     = get_theme_mod( 'button_primary_bg_color_alt' );
	$button_primary_text_color_alt   = get_theme_mod( 'button_primary_text_color_alt' );

	if ( $button_border_width ) {

		echo '.woocommerce a.button, .woocommerce button.button, .woocommerce a.button.alt, .woocommerce button.button.alt {';
		echo sprintf( 'border-width: %s;', esc_attr( $button_border_width ) . 'px' );
		echo 'border-style: solid;';

		if ( $button_primary_border_color ) {
			echo sprintf( 'border-color: %s;', esc_attr( $button_primary_border_color ) );
		}

		echo '}';

		if ( $button_primary_border_color_alt ) {

			echo '.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover {';
			echo sprintf( 'border-color: %s;', esc_attr( $button_primary_border_color_alt ) );
			echo '}';

		}

	}

	if ( $button_primary_bg_color || $button_primary_text_color || $button_border_radius ) {

		echo '.woocommerce a.button, .woocommerce button.button, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled]:hover {';

		if ( $button_border_radius ) {
			echo sprintf( 'border-radius: %s;', esc_attr( $button_border_radius ) . 'px' );
		}

		if ( $button_primary_bg_color ) {
			echo sprintf( 'background: %s;', esc_attr( $button_primary_bg_color ) );
		}

		if ( $button_primary_text_color ) {
			echo sprintf( 'color: %s;', esc_attr( $button_primary_text_color ) );
		}

		echo '}';

	}

	if ( $button_primary_bg_color_alt || $button_primary_text_color_alt ) {

		echo '.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover {';

		if ( $button_primary_bg_color_alt ) {
			echo sprintf( 'background: %s;', esc_attr( $button_primary_bg_color_alt ) );
		}

		if ( $button_primary_text_color_alt ) {
			echo sprintf( 'color: %s;', esc_attr( $button_primary_text_color_alt ) );
		}

		echo '}';

	}

	// Loop.
	$woocommerce_loop_custom_width                  = get_theme_mod( 'woocommerce_loop_custom_width' );
	$woocommerce_loop_content_alignment             = get_theme_mod( 'woocommerce_loop_content_alignment' );
	$woocommerce_loop_sale_alignment                = get_theme_mod( 'woocommerce_loop_sale_alignment' );
	$woocommerce_loop_sale_layout                   = get_theme_mod( 'woocommerce_loop_sale_layout' );
	$woocommerce_loop_sale_position                 = get_theme_mod( 'woocommerce_loop_sale_position' );
	$woocommerce_loop_sale_font_size                = get_theme_mod( 'woocommerce_loop_sale_font_size' );
	$woocommerce_loop_sale_font_color               = get_theme_mod( 'woocommerce_loop_sale_font_color' );
	$woocommerce_loop_sale_background_color         = get_theme_mod( 'woocommerce_loop_sale_background_color' );
	$woocommerce_loop_title_size                    = get_theme_mod( 'woocommerce_loop_title_size' );
	$woocommerce_loop_title_color                   = get_theme_mod( 'woocommerce_loop_title_color' );
	$woocommerce_loop_price_size                    = get_theme_mod( 'woocommerce_loop_price_size' );
	$woocommerce_loop_price_color                   = get_theme_mod( 'woocommerce_loop_price_color' );
	$woocommerce_single_price_color                 = get_theme_mod( 'woocommerce_single_price_color' );
	$woocommerce_loop_out_of_stock_font_size        = get_theme_mod( 'woocommerce_loop_out_of_stock_font_size' );
	$woocommerce_loop_out_of_stock_font_color       = get_theme_mod( 'woocommerce_loop_out_of_stock_font_color' );
	$woocommerce_loop_out_of_stock_background_color = get_theme_mod( 'woocommerce_loop_out_of_stock_background_color' );
	$woocommerce_loop_image_alignment               = get_theme_mod( 'woocommerce_loop_image_alignment' );
	$woocommerce_loop_image_width                   = get_theme_mod( 'woocommerce_loop_image_width' );
	$woocommerce_loop_layout                        = get_theme_mod( 'woocommerce_loop_layout' );

	if ( $woocommerce_loop_custom_width ) {

		echo '.archive.woocommerce #inner-content {';
		echo sprintf( 'max-width: %s;', esc_attr( $woocommerce_loop_custom_width ) );
		echo '}';

	}

	if ( $woocommerce_loop_content_alignment ) {

		echo '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {';
		echo sprintf( 'text-align: %s;', esc_attr( $woocommerce_loop_content_alignment ) );
		echo '}';

		if ( 'center' === $woocommerce_loop_content_alignment ) {

			echo '.woocommerce .products .star-rating {';
			echo 'margin: 0 auto 10px auto !important;';
			echo '}';

		}

		if ( 'right' === $woocommerce_loop_content_alignment ) {

			echo '.woocommerce .products .star-rating {';
			echo 'display: inline-block;';
			echo 'text-align: right;';
			echo '}';

		}

	}

	if ( 'list' === $woocommerce_loop_layout ) {

		echo '@media (min-width: ' . esc_attr( $breakpoint_mobile + 1 ) . 'px) {';

		echo '.potter-woo-list-view .potter-woo-loop-thumbnail-wrapper {';
		echo 'float: left;';
		echo 'width: 48%;';
		echo '}';

		echo '.potter-woo-list-view .potter-woo-loop-summary {';
		echo 'float: right;';
		echo 'width: 48%;';
		echo '}';

		echo '.potter-woo-list-view.woocommerce ul.products li.product a img, .potter-woo-list-view ul.products li.product a img {';
		echo 'margin-bottom: 0;';
		echo '}';

		echo '}';

	}

	if ( 'right' === $woocommerce_loop_image_alignment ) {

		echo '.potter-woo-list-view .potter-woo-loop-thumbnail-wrapper {';
		echo 'float: right;';
		echo '}';

		echo '.potter-woo-list-view .potter-woo-loop-summary {';
		echo 'float: left;';
		echo '}';

	}

	if ( $woocommerce_loop_image_width && '50' !== $woocommerce_loop_image_width ) {

		echo '@media (min-width: ' . esc_attr( $breakpoint_mobile + 1 ) . 'px) {';

		echo '.potter-woo-list-view .potter-woo-loop-thumbnail-wrapper {';
		echo sprintf( 'width: %s;', esc_attr( $woocommerce_loop_image_width ) - 2 . '%' );
		echo '}';

		echo '.potter-woo-list-view .potter-woo-loop-summary {';
		echo sprintf( 'width: %s;', 98 - esc_attr( $woocommerce_loop_image_width ) . '%' );
		echo '}';

		echo '}';

	}

	if ( 'right' === $woocommerce_loop_sale_alignment ) {

		echo '.woocommerce ul.products li.product .onsale {';
		echo 'right: 0;';
		echo 'left: auto;';
		echo 'margin-right: -10px;';
		echo '}';

	}

	if ( 'center' === $woocommerce_loop_sale_alignment ) {

		echo '.woocommerce ul.products li.product .onsale {';
		echo 'left: 50%;';
		echo 'width: 90px;';
		echo 'margin: 0 0 0 -45px;';
		echo 'height: auto;';
		echo 'line-height: 1;';
		echo 'padding: 8px 0;';
		echo 'border-radius: 0px;';
		if ( 'square' !== $woocommerce_loop_sale_layout ) {
			echo 'border-bottom-left-radius: 4px;';
			echo 'border-bottom-right-radius: 4px;';
		}
		echo '}';

	}

	if ( 'square' === $woocommerce_loop_sale_layout ) {

		echo '.woocommerce span.onsale {';
		echo 'border-radius: 0 !important;';
		echo '}';

	}

	if ( 'inside' === $woocommerce_loop_sale_position ) {

		if ( ! $woocommerce_loop_sale_alignment || 'left' === $woocommerce_loop_sale_alignment ) {

			echo '.woocommerce ul.products li.product .onsale {';
			echo 'margin: 10px 0 0 10px;';
			echo '}';

		}

		if ( 'right' === $woocommerce_loop_sale_alignment ) {

			echo '.woocommerce ul.products li.product .onsale {';
			echo 'margin: 10px 10px 0 0;';
			echo '}';

		}

		echo '.woocommerce span.onsale {';
		echo 'margin: 10px 0 0 10px;';
		echo '}';

	}

	if ( $woocommerce_loop_sale_font_size || $woocommerce_loop_sale_font_color || $woocommerce_loop_sale_background_color ) {

		echo '.woocommerce ul.products li.product .onsale, .woocommerce span.onsale {';

		if ( $woocommerce_loop_sale_font_size ) {
			echo sprintf( 'font-size: %s;', esc_attr( $woocommerce_loop_sale_font_size ) );
		}

		if ( $woocommerce_loop_sale_font_color ) {
			echo sprintf( 'color: %s !important;', esc_attr( $woocommerce_loop_sale_font_color ) );
		}

		if ( $woocommerce_loop_sale_background_color ) {
			echo sprintf( 'background-color: %s !important;', esc_attr( $woocommerce_loop_sale_background_color ) );
		}

		echo '}';

	}

	if ( $woocommerce_loop_title_size || $woocommerce_loop_title_color ) {

		echo '.woocommerce ul.products li.product h3, .woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product .woocommerce-loop-category__title {';

		if ( $woocommerce_loop_title_size ) {
			echo sprintf( 'font-size: %s;', esc_attr( $woocommerce_loop_title_size ) );
		}

		if ( $woocommerce_loop_title_color ) {
			echo sprintf( 'color: %s;', esc_attr( $woocommerce_loop_title_color ) );
		}

		echo '}';

	}

	if ( $woocommerce_loop_price_size || $woocommerce_loop_price_color ) {

		echo '.woocommerce ul.products li.product .price {';

		if ( $woocommerce_loop_price_size ) {
			echo sprintf( 'font-size: %s;', esc_attr( $woocommerce_loop_price_size ) );
		}

		if ( $woocommerce_loop_price_color ) {
			echo sprintf( 'color: %s;', esc_attr( $woocommerce_loop_price_color ) );
		}

		echo '}';

	}

	if ( ! $woocommerce_single_price_color && $woocommerce_loop_price_color ) {

		echo '.woocommerce div.product span.price, .woocommerce div.product p.price {';
		echo sprintf( 'color: %s;', esc_attr( $woocommerce_loop_price_color ) );
		echo '}';

	}

	if ( $woocommerce_loop_out_of_stock_font_size || $woocommerce_loop_out_of_stock_font_color || $woocommerce_loop_out_of_stock_background_color ) {

		echo '.woocommerce ul.products li.product .potter-woo-loop-out-of-stock {';

		if ( $woocommerce_loop_out_of_stock_font_size ) {
			echo sprintf( 'font-size: %s;', esc_attr( $woocommerce_loop_out_of_stock_font_size ) );
		}

		if ( $woocommerce_loop_out_of_stock_font_color ) {
			echo sprintf( 'color: %s;', esc_attr( $woocommerce_loop_out_of_stock_font_color ) );
		}

		if ( $woocommerce_loop_out_of_stock_background_color ) {
			echo sprintf( 'background-color: %s;', esc_attr( $woocommerce_loop_out_of_stock_background_color ) );
		}

		echo '}';

	}

	// Proudct.
	$woocommerce_single_custom_width                 = get_theme_mod( 'woocommerce_single_custom_width' );
	$woocommerce_single_layout                 = get_theme_mod( 'woocommerce_single_layout' );
	$woocommerce_single_alignment                    = get_theme_mod( 'woocommerce_single_alignment' );
	$woocommerce_single_image_width                  = get_theme_mod( 'woocommerce_single_image_width' );
	$woocommerce_single_summary_separator            = get_theme_mod( 'woocommerce_single_summary_separator' );
	$woocommerce_single_tabs_font_size               = get_theme_mod( 'woocommerce_single_tabs_font_size' );
	$woocommerce_single_tabs_font_color              = get_theme_mod( 'woocommerce_single_tabs_font_color' );
	$woocommerce_single_tabs_font_color_alt          = get_theme_mod( 'woocommerce_single_tabs_font_color_alt' );
	$woocommerce_single_tabs_font_color_active       = get_theme_mod( 'woocommerce_single_tabs_font_color_active' );
	$woocommerce_single_tabs                         = get_theme_mod( 'woocommerce_single_tabs' );
	$woocommerce_single_tabs_background_color        = get_theme_mod( 'woocommerce_single_tabs_background_color' );
	$woocommerce_single_tabs_background_color_alt    = get_theme_mod( 'woocommerce_single_tabs_background_color_alt' );
	$woocommerce_single_tabs_background_color_active = get_theme_mod( 'woocommerce_single_tabs_background_color_active' );
	$woocommerce_single_tabs_remove_headline         = get_theme_mod( 'woocommerce_single_tabs_remove_headline' );
	$woocommerce_single_price_size                   = get_theme_mod( 'woocommerce_single_price_size' );

	if ( $woocommerce_single_custom_width ) {

		echo '.single.woocommerce #inner-content {';
		echo sprintf( 'max-width: %s;', esc_attr( $woocommerce_single_custom_width ) );
		echo '}';

	}
	if ( 'left' === $woocommerce_single_layout ) {
		echo '';
	}

	if ( 'right' === $woocommerce_single_alignment ) {

		echo '.woocommerce div.product div.summary, .woocommerce #content div.product div.summary, .woocommerce-page div.product div.summary, .woocommerce-page #content div.product div.summary {';
		echo 'float: left;';
		echo '}';

		echo '.woocommerce div.product div.images, .woocommerce #content div.product div.images, .woocommerce-page div.product div.images, .woocommerce-page #content div.product div.images {';
		echo 'float: right;';
		echo '}';

		echo '.single-product.woocommerce span.onsale {';
		echo 'display: none;';
		echo '}';

	}

	if ( $woocommerce_single_image_width && '50' !== $woocommerce_single_image_width ) {

		echo '@media (min-width: ' . esc_attr( $breakpoint_medium + 1 ) . 'px) {';

		echo '.woocommerce div.product div.images, .woocommerce #content div.product div.images, .woocommerce-page div.product div.images, .woocommerce-page #content div.product div.images {';
		echo sprintf( 'width: %s !important;', esc_attr( $woocommerce_single_image_width ) - 2 . '%' );
		echo '}';

		echo '.woocommerce div.product div.summary, .woocommerce #content div.product div.summary, .woocommerce-page div.product div.summary, .woocommerce-page #content div.product div.summary {';
		echo sprintf( 'width: %s !important;', 98 - esc_attr( $woocommerce_single_image_width ) . '%' );
		echo '}';

		echo '}';

	}

	if ( 'show' === $woocommerce_single_summary_separator ) {

		echo '.woocommerce div.product form.cart {';
		echo 'padding-top: 20px;';
		echo 'padding-bottom: 20px;';
		echo 'border-top: 1px solid #d9d9e0;';
		echo 'border-bottom: 1px solid #d9d9e0;';
		echo '}';

	}

	if ( $woocommerce_single_tabs_font_size || $woocommerce_single_tabs_font_color ) {

		echo '.woocommerce div.product .woocommerce-tabs ul.tabs li a {';

		if ( $woocommerce_single_tabs_font_size ) {
			echo sprintf( 'font-size: %s;', esc_attr( $woocommerce_single_tabs_font_size ) );
		}

		if ( $woocommerce_single_tabs_font_color ) {
			echo sprintf( 'color: %s;', esc_attr( $woocommerce_single_tabs_font_color ) );
		}

		echo '}';

	}

	if ( $woocommerce_single_tabs_font_color_alt ) {

		echo '.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover {';
		echo sprintf( 'color: %s;', esc_attr( $woocommerce_single_tabs_font_color_alt ) );
		echo '}';

	}

	if ( $woocommerce_single_tabs_font_color_active ) {

		echo '.woocommerce div.product .woocommerce-tabs ul.tabs li.active a {';
		echo sprintf( 'color: %s;', esc_attr( $woocommerce_single_tabs_font_color_active ) );
		echo '}';

	}

	if ( ! $woocommerce_single_tabs || 'default' === $woocommerce_single_tabs ) {

		if ( $woocommerce_single_tabs_background_color ) {

			echo '.woocommerce div.product .woocommerce-tabs ul.tabs li {';
			echo sprintf( 'background-color: %s;', esc_attr( $woocommerce_single_tabs_background_color ) );
			echo '}';

		}

		if ( $woocommerce_single_tabs_background_color_alt ) {

			echo '.woocommerce div.product .woocommerce-tabs ul.tabs li:hover {';
			echo sprintf( 'background-color: %s;', esc_attr( $woocommerce_single_tabs_background_color_alt ) );
			echo sprintf( 'border-bottom-color: %s;', esc_attr( $woocommerce_single_tabs_background_color_alt ) );
			echo '}';

		}

		if ( $woocommerce_single_tabs_background_color_active ) {

			echo '.woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active:hover {';
			echo sprintf( 'background-color: %s;', esc_attr( $woocommerce_single_tabs_background_color_active ) );
			echo sprintf( 'border-bottom-color: %s;', esc_attr( $woocommerce_single_tabs_background_color_active ) );
			echo '}';

		}

	}

	if ( 'modern' === $woocommerce_single_tabs ) {

		echo '.woocommerce div.product .woocommerce-tabs ul.tabs {';
		echo 'border-top: 1px solid #d9d9e0;';
		echo '}';

		echo '.woocommerce div.product .woocommerce-tabs ul.tabs li {';
		echo 'border-bottom: none !important;';
		echo 'border-left: none !important;';
		echo 'border-right: none !important;';
		echo 'border-top: 5px solid transparent !important;';
		echo 'background: none !important;';
		echo 'margin: 0 40px 0 0;';
		echo '}';

		echo '.woocommerce div.product .woocommerce-tabs ul.tabs li a {';
		echo 'padding-left: 0;';
		echo 'padding-right: 0;';
		echo '}';

		echo '.woocommerce div.product .woocommerce-tabs ul.tabs li:last-child {';
		echo 'border-right: none;';
		echo '}';

		echo '.woocommerce div.product .woocommerce-tabs ul.tabs li:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active:hover {';
		echo 'background: none;';
		echo '}';

		echo '.woocommerce div.product .woocommerce-tabs ul.tabs li.active {';
		echo 'background: none;';
		echo 'border-left: none !important;';

		if ( $woocommerce_single_tabs_font_color_active ) {
			echo sprintf( 'border-top: 5px solid %s !important;', esc_attr( $woocommerce_single_tabs_font_color_active ) );
		} elseif ( $page_accent_color ) {
			echo sprintf( 'border-top: 5px solid %s !important;', esc_attr( $page_accent_color ) );
		} else {
			echo 'border-top: 5px solid #0056FF !important;';
		}

		echo '}';

		echo '.woocommerce div.product .woocommerce-tabs .panel {';
		echo 'padding: 0 !important;';
		echo 'border: none !important;';
		echo 'margin-top: 30px !important;';
		echo '}';

	}

	if ( $woocommerce_single_tabs_remove_headline ) {

		echo '.woocommerce div.product .woocommerce-tabs .panel h2:first-child {';
		echo 'display: none;';
		echo '}';

	}

	if ( $woocommerce_single_price_size ) {

		echo '.woocommerce div.product span.price, .woocommerce div.product p.price {';
		echo sprintf( 'font-size: %s;', esc_attr( $woocommerce_single_price_size ) );
		echo '}';

	}

	if ( $woocommerce_single_price_color ) {

		echo '.woocommerce div.product span.price, .woocommerce div.product p.price {';
		echo sprintf( 'color: %s;', esc_attr( $woocommerce_single_price_color ) );
		echo '}';

	}

	// Checkout.
	$woocommerce_checkout_layout = get_theme_mod( 'woocommerce_checkout_layout' );

	if ( 'side' === $woocommerce_checkout_layout ) {

		echo '.woocommerce-checkout .col2-set {';
		echo 'width: 53% !important;';
		echo 'float: left;';
		echo '}';

		echo '.woocommerce-checkout .col2-set .col-1, .woocommerce-checkout .col2-set .col-2 {';
		echo 'float: none;';
		echo 'width: 100% !important;';
		echo '}';

		echo '#order_review_heading {';
		echo 'float: right;';
		echo 'width: 42%;';
		echo '}';

		echo '.woocommerce-checkout-review-order {';
		echo 'width: 42%;';
		echo 'float: right;';
		echo '}';

		echo '.woocommerce #payment #place_order, .woocommerce-page #payment #place_order {';
		echo 'width: 100%;';
		echo '}';

		echo '@media screen and (max-width: ' . esc_attr( $breakpoint_medium ) . 'px) {';

		echo '.woocommerce-checkout .col2-set, #order_review_heading, .woocommerce-checkout-review-order {';
		echo 'width: 100% !important;';
		echo 'float: none;';
		echo '}';

		echo '}';

	}

}
add_action( 'potter_after_customizer_css', 'potter_do_woocommerce_customizer_css', 10 );

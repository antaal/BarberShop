<?php
/**
 * WooCommerce functions.
 *
 * @package Potter
 * @subpackage Integration/WooCommerce
 */

defined('ABSPATH') || die("Can't access directly");


/**
 * Enqueue scripts & styles.
 */
function potter_woo_fragment_refresh()
{

    wp_enqueue_script('potter-woocommerce-fragment-refresh', get_template_directory_uri() . '/assets/woocommerce/js/woocommerce-fragment-refresh.js', array( 'jquery' ), '', true);

    // Single add to cart ajax.
    if (is_product() && 'yes' === get_option('woocommerce_enable_ajax_add_to_cart') && get_theme_mod('woocommerce_single_add_to_cart_ajax')) {
        wp_enqueue_script('potter-woocommerce-single-add-to-cart-ajax', get_template_directory_uri() . '/assets/woocommerce/js/woocommerce-single-add-to-cart-ajax.js', array( 'jquery' ), '', true);
    }
    $woocommerce_loop_image_flip = get_theme_mod('woocommerce_loop_image_flip');
    if ($woocommerce_loop_image_flip) {
        require_once POTTER_THEME_DIR . '/inc/integration/woocommerce/woocommerce-product-image-flipper.php';
    }

}
add_action('wp_enqueue_scripts', 'potter_woo_fragment_refresh');



/**
 * Deregister defaults.
 */
function potter_woo_deregister_defaults()
{

    // Default sidebar.
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

    // Default wrappers.
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

    // Loop.
    remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
}
add_action('wp', 'potter_woo_deregister_defaults', 10);

/**
 * Register defaults.
 */
function potter_woo_register_defaults()
{
    add_action('woocommerce_after_shop_loop_item', 'potter_woo_loop_content');
}
add_action('wp', 'potter_woo_register_defaults', 20);

/**
 * Remove first & last classes from loop.
 *
 * @param array $classes The post classes.
 *
 * @return array The updated post classes.
 */
function potter_woo_loop_remove_first_last_class($classes)
{
    if ('product' === get_post_type()) {
        $classes = array_diff($classes, array( 'first', 'last' ));
    }

    return $classes;
}
add_filter('post_class', 'potter_woo_loop_remove_first_last_class', 21);

/**
 * Register sidebars.
 */
function potter_woo_sidebar()
{

    // Shop page sidebar.
    register_sidebar(array(
        'id'            => 'potter-woocommerce-sidebar',
        'name'          => __('WooCommerce Sidebar', 'potter'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="potter-widgettitle">',
        'after_title'   => '</h4>',
        'description'   => __('This Sidebar is being displayed on WooCommerce Archive Pages.', 'potter'),
    ));

    // Product page sidebar.
    register_sidebar(array(
        'id'            => 'potter-woocommerce-product-sidebar',
        'name'          => __('WooCommerce Product Page Sidebar', 'potter'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="potter-widgettitle">',
        'after_title'   => '</h4>',
        'description'   => __('This Sidebar is being displayed on WooCommerce Product Pages.', 'potter'),
    ));
}
add_action('widgets_init', 'potter_woo_sidebar');

/**
 * Filter sidebars.
 *
 * @param string $sidebar The sidebar.
 *
 * @return string The updated sidebar.
 */
function potter_woo_sidebars($sidebar)
{
    if (is_woocommerce()) {
        if (is_product()) {
            $sidebar = 'potter-woocommerce-product-sidebar';
        } else {
            $sidebar = 'potter-woocommerce-sidebar';
        }
    }

    return $sidebar;
}
add_filter('potter_do_sidebar', 'potter_woo_sidebars');

/**
 * Construct starting wrapper.
 */
function potter_woo_output_content_wrapper()
{
    $grid_gap = get_theme_mod('sidebar_gap', 'medium');

    echo '<div id="content">';

    do_action('potter_content_open');

    potter_inner_content();

    do_action('potter_inner_content_open');

    echo '<div class="potter-grid potter-main-grid potter-grid-' . esc_attr($grid_gap) . '">';

    do_action('potter_sidebar_left');

    echo '<main id="main" class="potter-main potter-medium-2-3' . potter_archive_class() . '">';

    do_action('potter_main_content_open');
}
add_action('woocommerce_before_main_content', 'potter_woo_output_content_wrapper', 10);

/**
 * Construct closing wrapper.
 */
function potter_woo_output_content_wrapper_end()
{
    do_action('potter_main_content_close');

    echo '</main>';

    do_action('potter_sidebar_right');

    do_action('potter_inner_content_close');

    potter_inner_content_close();

    do_action('potter_content_close');

    echo '</div>';
}
add_action('woocommerce_after_main_content', 'potter_woo_output_content_wrapper_end', 10);

/**
 * Filter sidebar layout.
 *
 * @param string $sidebar The sidebar layout.
 *
 * @return string The updated sidebar layout.
 */
function potter_woo_sidebar_layout($sidebar)
{
    if (is_product()) {
        $sidebar = get_theme_mod('woocommerce_single_sidebar_layout', 'none');

        $id               = get_the_ID();
        $sidebar_position = get_post_meta($id, 'potter_sidebar_position', true);

        if ($sidebar_position && 'global' !== $sidebar_position) {
            $sidebar = $sidebar_position;
        }
    } elseif (is_shop() || is_product_category()) {
        $sidebar = get_theme_mod('woocommerce_sidebar_layout', 'none');
    }

    return $sidebar;
}
add_filter('potter_sidebar_layout', 'potter_woo_sidebar_layout');

/**
 * Apply content/archive class.
 *
 * @param string $archive_class The archive class.
 *
 * @return string The updated archive class.
 */
function potter_woo_archive_class($archive_class)
{
    if (is_product()) {
        $archive_class = ' potter-product-content';
    } elseif (is_shop() || is_product_category()) {
        $archive_class = ' potter-product-archive';
    }

    return $archive_class;
}
add_filter('potter_archive_class', 'potter_woo_archive_class');

/**
 * Construct starting product loop wrapper.
 */
function potter_woo_product_loop_start()
{
    $mobile_breakpoint  = get_theme_mod('woocommerce_loop_products_per_row_mobile', 1);
    $tablet_breakpoint  = get_theme_mod('woocommerce_loop_products_per_row_tablet', 3);
    $desktop_breakpoint = get_theme_mod('woocommerce_loop_products_per_row_desktop', 4);
    $grid_gap           = get_theme_mod('woocommerce_loop_grid_gap', 'large');

    return '<ul class="potter-grid potter-grid-' . esc_attr($grid_gap) . ' potter-grid-1-' . esc_attr($mobile_breakpoint) . ' potter-grid-small-1-' . esc_attr($tablet_breakpoint) . ' potter-grid-large-1-' . esc_attr($desktop_breakpoint) . ' products">';
}
add_filter('woocommerce_product_loop_start', 'potter_woo_product_loop_start', 0);

/**
 * Construct ending product loop wrapper.
 */
function potter_woo_product_loop_end()
{
    return '</ul>';
}
add_filter('woocommerce_product_loop_end', 'potter_woo_product_loop_end', 0);

/**
 * Construct starting product wrapper.
 */
function potter_woo_loop_product_wrap_start()
{
    echo '<div class="potter-woo-product-wrapper potter-clearfix">';
}
add_action('woocommerce_before_shop_loop_item', 'potter_woo_loop_product_wrap_start', 0);

/**
 * Construct ending product wrapper.
 */
function potter_woo_loop_product_wrap_end()
{
    echo '</div>';
}
add_action('woocommerce_after_shop_loop_item', 'potter_woo_loop_product_wrap_end', 100);

/**
 * Construct starting thumbnail wrapper.
 */
function potter_woo_loop_thumbnail_wrap_start()
{
    echo '<div class="potter-woo-loop-thumbnail-wrapper">';
    echo '<a href="' . esc_url(get_the_permalink()) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
}
add_action('woocommerce_before_shop_loop_item_title', 'potter_woo_loop_thumbnail_wrap_start', 5);

/**
 * Construct ending thumbnail wrapper.
 */
function potter_woo_loop_thumbnail_wrap_end()
{
    echo '</a>';
    echo '</div>';
}
add_action('woocommerce_before_shop_loop_item_title', 'potter_woo_loop_thumbnail_wrap_end', 12);

/**
 * Remove sale badge from loop.
 */
function potter_woo_loop_remove_sale_badge()
{
    $sale_badge_position = get_theme_mod('woocommerce_loop_sale_position');

    if ($sale_badge_position && 'none' === $sale_badge_position) {
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
    }
}
add_action('wp', 'potter_woo_loop_remove_sale_badge');

/**
 * Hide WooCommerce page title on archives.
 *
 * @param string $page_title The page title.
 *
 * @return boolean|string Wether to display the page title or not.
 */
function potter_woo_loop_remove_page_title($page_title)
{
    if (get_theme_mod('woocommerce_loop_remove_page_title')) {
        $page_title = false;
    }

    return $page_title;
}
add_filter('woocommerce_show_page_title', 'potter_woo_loop_remove_page_title');

/**
 * Remove WooCommerce breadcrumbs from shop pages.
 */
function potter_woo_loop_remove_breadcrumbs()
{
    if (get_theme_mod('woocommerce_loop_remove_breadcrumbs')) {
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
    }
}
add_action('wp', 'potter_woo_loop_remove_breadcrumbs');

/**
 * Remove the results count from shop pages.
 */
function potter_woo_loop_remove_result_count()
{
    if (get_theme_mod('woocommerce_loop_remove_result_count')) {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    }
}
add_action('wp', 'potter_woo_loop_remove_result_count');

/**
 * Remove the sorting dropdown from shop pages.
 */
function potter_woo_loop_remove_ordering()
{
    if (get_theme_mod('woocommerce_loop_remove_ordering')) {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    }
}
add_action('wp', 'potter_woo_loop_remove_ordering');

/**
 * Construct out of stock notice.
 */
function potter_woo_loop_out_of_stock()
{
    $out_of_stock_notice = get_theme_mod('woocommerce_loop_out_of_stock_notice');

    if (! $out_of_stock_notice || 'hide' !== $out_of_stock_notice) {
        $out_of_stock        = get_post_meta(get_the_ID(), '_stock_status', true);
        $out_of_stock_string = apply_filters('potter_woo_loop_out_of_stock_string', __('Out of stock', 'potter'));

        if ('outofstock' === $out_of_stock) {
            echo '<span class="potter-woo-loop-out-of-stock">' . esc_html($out_of_stock_string) . '</span>';
        }
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'potter_woo_loop_out_of_stock', 11);

/**
 * Add parent category to loop.
 */
function potter_woo_loop_category()
{
    ?>
	<span class="potter-woo-product-category">
		<?php
        global $product;
    $categories = function_exists('wc_get_product_category_list') ? wc_get_product_category_list(get_the_ID(), ',', '', '') : $product->get_categories(',', '', '');

    $categories = strip_tags($categories);
    if ($categories) {
        list($parent_category) = explode(',', $categories);
        echo esc_html($parent_category);
    } ?>
	</span>
	<?php
}

/**
 * Construct loop title.
 */
function potter_woo_loop_title()
{
    echo '<a href="' . esc_url(get_the_permalink()) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
    echo '<h3 class="woocommerce-loop-product__title">' . get_the_title() . '</h3>';
    echo '</a>';
}

/**
 * Construct loop short description.
 */
function potter_woo_loop_short_description()
{
    if (has_excerpt()) {
        ?>
		<div class="potter-woo-loop-excerpt">
			<?php the_excerpt(); ?>
		</div>
		<?php
    }
}

/**
 * Construct sortable loop content.
 */
function potter_woo_loop_content()
{
    $content = get_theme_mod('woocommerce_loop_sortable_content', array( 'category', 'title', 'price', 'add_to_cart' ));

    if (is_array($content) && ! empty($content)) {
        do_action('potter_woo_loop_before_summary');
        echo '<div class="potter-woo-loop-summary">';
        do_action('potter_woo_loop_summary_open');

        foreach ($content as $value) {
            switch ($value) {
            case 'title':
                do_action('potter_woo_loop_before_title');
                potter_woo_loop_title();
                do_action('potter_woo_loop_after_title');
                break;
            case 'price':
                do_action('potter_woo_loop_before_price');
                woocommerce_template_loop_price();
                do_action('potter_woo_loop_after_price');
                break;
            case 'rating':
                do_action('potter_woo_loop_before_rating');
                woocommerce_template_loop_rating();
                do_action('potter_woo_loop_after_rating');
                break;
            case 'excerpt':
                do_action('potter_woo_loop_before_excerpt');
                potter_woo_loop_short_description();
                do_action('potter_woo_loop_after_excerpt');
                break;
            case 'add_to_cart':
                do_action('potter_woo_loop_before_add_to_cart');
                woocommerce_template_loop_add_to_cart();
                do_action('potter_woo_loop_after_add_to_cart');
                break;
            case 'category':
                do_action('potter_woo_loop_before_category');
                potter_woo_loop_category();
                do_action('potter_woo_loop_after_category');
                break;
            default:
                break;
            }
        }

        do_action('potter_woo_loop_summary_close');
        echo '</div>';
        do_action('potter_woo_loop_after_summary');
    }
}

/**
 * Products per row.
 */
function potter_loop_columns()
{
    $columns = get_theme_mod('woocommerce_loop_products_per_row_desktop', 4);
    return $columns;
}
add_filter('loop_shop_columns', 'potter_loop_columns');

/**
 * Current menu item class.
 *
 * Add class to WooCommerce menu item if we're on the cart page.
 *
 * @param string $css_classes The css classes.
 *
 * @return string The updated css classes.
 */
function potter_woo_menu_item_class_current($css_classes)
{
    if (is_cart()) {
        $css_classes .= ' current-menu-item';
    }

    return $css_classes;
}
add_filter('potter_woo_menu_item_classes', 'potter_woo_menu_item_class_current');

/**
 * Construct cart menu item.
 *
 * @return string The cart menu item.
 */


function potter_woo_menu_item()
{

    // Vars.
    $icon        = get_theme_mod('woocommerce_menu_item_icon', 'cart');
    $css_classes = apply_filters('potter_woo_menu_item_classes', 'potter-woo-menu-item');
    $title       = apply_filters('potter_woo_menu_item_title', __('Shopping Cart', 'potter'));
    $cart_count  = WC()->cart->get_cart_contents_count();
    $cart_url    = wc_get_cart_url();

    // Construct.
    $menu_item  = '<li class="' . esc_attr($css_classes) . '">';

    if ('offcanvas' === get_theme_mod('woocommerce_menu_item_link')) {
        $menu_item .= '<a id="offminicartbtn" title="' . esc_attr($title) . '">';
    } else {
        $menu_item .= '<a href="' . esc_url($cart_url) . '" title="' . esc_attr($title) . '">';
    }

    $menu_item .= '<span class="screen-reader-text">' . __('Shopping Cart', 'potter') . '</span>';

    $menu_item .= apply_filters('potter_woo_before_menu_item', '');

    $menu_item .= '<i class="potterf potterf-' . esc_attr($icon) . '"></i>';

    if ('hide' !== get_theme_mod('woocommerce_menu_item_count')) {
        $menu_item .= '<span class="potter-woo-menu-item-count">' . wp_kses_data($cart_count) . '<span class="screen-reader-text">' . __('Items in Cart', 'potter') . '</span></span>';
    }

    $menu_item .= apply_filters('potter_woo_after_menu_item', '');

    $menu_item .= '</a>';

    $menu_item .= apply_filters('potter_woo_menu_item_dropdown', '');

    $menu_item .= '</li>';
    return $menu_item;
}




/**
 * Add cart menu item to main navigation.
 *
 * @param string $items The HTML list content for the menu items.
 * @param object $args The arguments.
 *
 * @return string The updated HTML.
 */
function potter_woo_menu_icon($items, $args)
{

    // Stop right here if menu item is hidden.
    if ('hide' === get_theme_mod('woocommerce_menu_item_desktop')) {
        return $items;
    }

    // Hide if we're on non-WooCommerce pages.
    if (get_theme_mod('woocommerce_menu_item_hide_if_not_wc') && ! is_woocommerce()) {
        return $items;
    }

    // Stop here if we're on a off canvas menu.
    if (potter_is_off_canvas_menu()) {
        return $items;
    }

    // Finally, add menu item to main menu.
    if ('main_menu' === $args->theme_location) {
        $items .= potter_woo_menu_item();
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'potter_woo_menu_icon', 10, 2);

/**
 * Add cart menu item to mobile navigation.
 */
function potter_woo_menu_icon_mobile()
{

    // Stop right here if menu item is hidden.
    if ('hide' === get_theme_mod('woocommerce_menu_item_mobile')) {
        return;
    }

    // Hide if we're on non-WooCommerce pages.
    if (get_theme_mod('woocommerce_menu_item_hide_if_not_wc') && ! is_woocommerce()) {
        return;
    }

    // Construct.
    $menu_item  = '<ul class="potter-mobile-nav-item">';
    $menu_item .= potter_woo_menu_item();
    $menu_item .= '</ul>';

    echo $menu_item;
}
add_action('potter_before_mobile_toggle', 'potter_woo_menu_icon_mobile');

/**
 * Add cart menu item to off canvas menu.
 */
function potter_woo_menu_icon_offcanvas()
{

    // Stop right here if menu item is hidden.
    if ('hide' === get_theme_mod('woocommerce_menu_item_desktop')) {
        return;
    }

    // Hide if we're on non-WooCommerce pages.
    if (get_theme_mod('woocommerce_menu_item_hide_if_not_wc') && ! is_woocommerce()) {
        return;
    }

    // Construct.
    $menu_item  = '<ul class="potter-mobile-nav-item">';
    $menu_item .= potter_woo_menu_item();
    $menu_item .= '</ul>';

    echo $menu_item;
}
add_action('potter_before_menu_toggle', 'potter_woo_menu_icon_offcanvas');

/**
 * WooCommerce fragments.
 *
 * @param array $fragments The fragments.
 *
 * @return array The updated fragments.
 */
function potter_woo_fragments($fragments)
{
    $fragments['li.potter-woo-menu-item'] = potter_woo_menu_item();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'potter_woo_fragments');

/* cart dropdown Cart


/**
 * Add WooCommerce menu item dropdown.
 *
 * @return string The menu item dropdown.
 */
function potter_woo_do_menu_item_dropdown() {

	$label           = apply_filters( 'potter_woo_menu_item_label', __( 'Cart', 'potter' ) );
	$cart_items      = WC()->cart->get_cart();
	$cart_url        = wc_get_cart_url();
	$checkout_url    = wc_get_checkout_url();
	$cart_button     = get_theme_mod( 'woocommerce_menu_item_dropdown_cart_button' );
	$checkout_button = get_the_title( 'woocommerce_menu_item_dropdown_checkout_button' );

	// Construct.
	$menu_item = '';

  if ( $cart_items && 'dropdowncart' === get_theme_mod( 'woocommerce_menu_item_link' ) ) {
		$menu_item .= '<ul class="potter-woo-sub-menu">';
		$menu_item .= '<li>';
		$menu_item .= '<div class="potter-woo-sub-menu-table-wrap">';
		$menu_item .= '<table class="potter-table">';
		$menu_item .= '<thead>';
		$menu_item .= '<tr>';
		$menu_item .= '<th>' . __( 'Product/s', 'potter' ) . '</th>';
		$menu_item .= '<th>' . __( 'Quantity', 'potter' ) . '</th>';
		$menu_item .= '</tr>';
		$menu_item .= '</thead>';

		$menu_item .= '<tbody>';

		foreach ( $cart_items as $cart_item => $values ) {

			$product   = wc_get_product( $values['data']->get_id() );
			$item_name = $product->get_name();
			$quantity  = $values['quantity'];
			$image     = $product->get_image();
			$link      = $product->get_permalink();
			// $price		= $product->get_price();

			$menu_item .= '<tr>';
			$menu_item .= '<td>';
			$menu_item .= '<div class="potter-woo-sub-menu-product-wrap">';
			if ( $image ) {
				$menu_item .= '<a class="potter-woo-sub-menu-image-wrap" href="' . esc_url( $link ) . '">';
				$menu_item .= $image;
				$menu_item .= '</a>';
			}
			$menu_item .= '<a class="potter-woo-sub-menu-title-wrap" href="' . esc_url( $link ) . '">';
			$menu_item .= $item_name;
			$menu_item .= '</a>';
			$menu_item .= '</div>';
			$menu_item .= '</td>';
			$menu_item .= '<td>';
			$menu_item .= $quantity;
			$menu_item .= '</td>';
			$menu_item .= '</tr>';

		}

		$menu_item .= '</tbody>';
		$menu_item .= '</table>';
		$menu_item .= '</div>';

		$menu_item .= '<div class="potter-woo-sub-menu-summary-wrap">';
		$menu_item .= '<div>' . __( 'Subtotal', 'potter' ) . '</div>';
		$menu_item .= '<div>' . WC()->cart->get_cart_subtotal() . '</div>';
		$menu_item .= '</div>';


	$menu_item .= '<div class="potter-woo-sub-menu-button-wrap">';
  $menu_item .= '<a href="' . esc_url( $cart_url ) . '" class="potter-button">' . esc_html( $label ) . '</a>';
  $menu_item .= '<a href="' . esc_url( $checkout_url ) . '" class="potter-button-primary">' . __( 'Checkout', 'potter' ) . '</a>';
  $menu_item .= '</div>';
		$menu_item .= '</li>';
		$menu_item .= '</ul>';

}

	return $menu_item;
}
add_filter( 'potter_woo_menu_item_dropdown', 'potter_woo_do_menu_item_dropdown' );



/**
* minicart off canvas
* @return string The offcanvas cart
*/
function potter_offcabvas_minicart() {
	//construct-minicart
		echo '<div class="offminicart" id="offcanvas-mincart">';
		echo '<i class="potter-close potterf potterf-times" aria-hidden="true"></i>';
		apply_filters('potter_woo_offcanvas_minicart_before', '');
		echo '<div class="widget_shopping_cart_content">';
					woocommerce_mini_cart();
		echo '</div>';
		apply_filters('potter_woo_offcanvas_minicart_after', '');
		echo '</div>';

}

  if ('offcanvas' === get_theme_mod('woocommerce_menu_item_link')) {
  add_filter('potter_before_header_open', 'potter_offcabvas_minicart');
  }


/**
 * Add to cart ajax on product pages.
 */
function potter_woo_single_add_to_cart_ajax()
{

    // Stop here if WooCommerce add to cart ajax is disabled.
    if ('yes' !== get_option('woocommerce_enable_ajax_add_to_cart')) {
        return;
    }

    // Stop here if WooCommerce add to cart ajax for product pages is not enabled.
    if (! get_theme_mod('woocommerce_single_add_to_cart_ajax')) {
        return;
    }

    $product_id        = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity          = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id      = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status    = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array( $product_id => $quantity ), true);
        }

        WC_AJAX::get_refreshed_fragments();
    } else {
        $data = array(
            'error'       => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id) );

        echo wp_send_json($data);
    }

    wp_die();
}
add_action('wp_ajax_potter_woo_single_add_to_cart_ajax', 'potter_woo_single_add_to_cart_ajax');
add_action('wp_ajax_nopriv_potter_woo_single_add_to_cart_ajax', 'potter_woo_single_add_to_cart_ajax');

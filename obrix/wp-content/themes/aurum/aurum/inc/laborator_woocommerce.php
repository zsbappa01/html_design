<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && class_exists( 'WooCommerce' ) )
	return;

// Shop Constants
define("SHOP_SIDEBAR", get_data('shop_sidebar') != 'hide');

// Shop Columns
$shop_columns = SHOP_SIDEBAR ? 3 : 4;

switch(get_data('shop_product_columns'))
{
	case "six":
		$shop_columns = 6;
		break;

	case "five":
		$shop_columns = 5;
		break;

	case "four":
		$shop_columns = 4;
		break;

	case "three":
		$shop_columns = 3;
		break;

	case "two":
		$shop_columns = 2;
		break;
}

define("SHOP_COLUMNS", $shop_columns);
define("SHOP_SINGLE_SIDEBAR", get_data('shop_single_sidebar') != 'hide');

# Remove Actions
remove_action( 'woocommerce_before_main_content', 			'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_shop_loop', 				'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 				'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop_item_title', 	'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop', 				'woocommerce_pagination', 10 );
//remove_action( 'woocommerce_after_single_product_summary', 	'woocommerce_upsell_display', 15 );
//remove_action( 'woocommerce_after_single_product_summary', 	'woocommerce_output_related_products', 20 );
//remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_subcategory_title', 		'woocommerce_subcategory_thumbnail', 10 );

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );

add_action( 'woocommerce_before_main_content', 'wc_print_notices', 10 );

remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );


# Custom Filters & Actions
add_filter( 'loop_shop_per_page', 'laborator_woocommerce_loop_shop_per_page', 1000 );

add_filter( 'woocommerce_single_product_image_thumbnail_html', 'laborator_single_product_image_thumbnail_html' );

#add_filter( 'woocommerce_product_review_list_args', 'laborator_woocommerce_reviews_list_comments_arr' );

	# Move Price Below description
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_filter( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

	# Remove add to cart on "Catalog mode"
	if(get_data('shop_catalog_mode')) {
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
		
		if ( get_data( 'shop_catalog_mode_hide_prices' ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
		}
	}

	# Remove product meta
	if(get_data('shop_single_meta_show') == false)
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

	# Share Item
	if(get_data('shop_share_product'))
		add_action('woocommerce_share', 'laborator_woocommerce_share');

	# Related Products
	add_filter('woocommerce_output_related_products_args', 'laborator_woocommerce_related_products_args');


# Wrapping Custom Pages
//add_action('woocommerce_before_template_part', 'laborator_before_template_part');
//add_action('woocommerce_after_template_part', 'laborator_after_template_part');


# Before Wrapper
function laborator_woocommerce_before()
{
	?>
	<section class="shop<?php echo is_single() ? ' shop-item-single' : ''; ?>">
		<div class="container woocommerce">

	<?php
}

# After Wrapper
function laborator_woocommerce_after()
{
	?>
		</div>
	</section>
	<?php
}

# Products per Page
function laborator_woocommerce_loop_shop_per_page()
{
	$rows_count = absint(get_data('shop_products_per_page'));
	$rows_count = $rows_count > 0 ? $rows_count : 4;

	return SHOP_COLUMNS * $rows_count;
}


// Aurum-styled Minicart Contents
function laborator_woocommerce_get_mini_cart_contents()
{
	ob_start();

	get_template_part('tpls/woocommerce-mini-cart');

	return ob_get_clean();
}


# Share Product Item
function laborator_woocommerce_share()
{
	global $product;

	$as_icons = get_data( 'shop_share_product_icons' );
	?>
	<div class="share-post <?php echo $as_icons ? ' share-post-icons' : ''; ?>">
		<h3><?php _e('Share this item:', 'aurum'); ?></h3>
		<div class="share-product share-post-links list-unstyled list-inline">
		<?php
		$share_product_networks = get_data('shop_share_product_networks');
		
		if ( $as_icons ) {
			add_filter( 'aurum_shop_product_single_share', '__return_true', 100 );
		}

		if(is_array($share_product_networks)):

			foreach($share_product_networks['visible'] as $network_id => $network):

				if($network_id == 'placebo')
					continue;

				share_story_network_link($network_id, $product->get_id(), false);

			endforeach;

		endif;
		?>
		</div>
	</div>
	<?php
}


# Related Product Counts
function laborator_woocommerce_related_products_args($args)
{
	$args['posts_per_page']    = get_data('shop_related_products_per_page');
	$args['columns']           = $args['posts_per_page'];

	return $args;
}



# Content Wrappers
global $laborator_woocommerce_wrap_pages;

$laborator_woocommerce_wrap_pages = array(
	'cart/cart.php',
	'checkout/form-checkout.php',
	'myaccount/form-login.php',
	'myaccount/my-account.php',
	'myaccount/form-edit-address.php',
	'myaccount/form-edit-account.php',
	'myaccount/form-lost-password.php',
	'myaccount/view-order.php',
	'checkout/thankyou.php',
	'order/form-tracking.php',
	'order/tracking.php',
);


function laborator_before_template_part($template_name)
{
	global $laborator_woocommerce_wrap_pages;

	foreach($laborator_woocommerce_wrap_pages as $template)
	{
		if($template == $template_name)
		{
			laborator_woocommerce_before();
		}
	}
}

function laborator_after_template_part($template_name)
{
	global $laborator_woocommerce_wrap_pages;

	foreach($laborator_woocommerce_wrap_pages as $template)
	{
		if($template == $template_name)
		{
			laborator_woocommerce_after();
		}
	}
}


function laborator_single_product_image_thumbnail_html($html)
{
	$html = str_replace('data-rel="prettyPhoto[product-gallery]"', 'data-lightbox-gallery="shop-gallery"', $html);
	return $html;
}


# Payment Method Title
add_action('woocommerce_review_order_before_payment', 'laborator_woocommerce_review_order_before_payment');

function laborator_woocommerce_review_order_before_payment()
{
	?>
	<div class="vspacer"></div>
	<h2 id="payment_method_heading"><?php _e('Payment Method', 'aurum'); ?></h2>
	<?php
}


# Remove WooCommerce styles and scripts.
function laborator_woocommerce_remove_lightboxes()
{
	// Styles
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

	// Scripts
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
	wp_dequeue_script( 'fancybox' );
	wp_dequeue_script( 'enable-lightbox' );
}

add_action( 'wp_enqueue_scripts', 'laborator_woocommerce_remove_lightboxes', 99 );


# Temporary remove title bug in WooCommerce
remove_filter('the_title', 'wc_page_endpoint_title');

# WooCommerce Pagination change place 
if( get_data( 'shop_loop_masonry' ) ) {	
	add_action( 'woocommerce_after_main_content', 'woocommerce_pagination' );
}
add_action( 'wp_enqueue_scripts', 'laborator_woocommerce_remove_lightboxes', 99 );


// Variation Images
function change_wc_variation_image_size( $child_id, $instance, $variation ) {
	$attachment_id         = get_post_thumbnail_id( $variation->get_id() );
	$attachment            = wp_get_attachment_image_src( $attachment_id, 'shop-thumb-main' );
	$image_src             = $attachment ? current( $attachment ) : '';
	$child_id['image_src'] = $image_src;
	
	return $child_id;
}

add_filter( 'woocommerce_available_variation', 'change_wc_variation_image_size', 10, 3 );

// Wishlist Title
add_filter( 'yith_wcwl_wishlist_title', 'yith_wcwl_wishlist_title_replace' );

function yith_wcwl_wishlist_title_replace( $title ) {
	
	$subtitle = '<small>' . __('Your favorite list of products', 'aurum') . '</small>';
	
	?>
	<div class="page-title">
		<?php echo str_replace( '</h2>', $subtitle . '</h2>', $title ); ?>
	</div>
	<?php
}


// Shop Item Thumbnail
function aurum_shop_loop_item_thumbnail() {
	?>
	<div class="item-image">
		<?php get_template_part('tpls/woocommerce-item-thumbnail'); ?>

		<?php if(get_data('shop_item_preview_type') != 'none'): ?>
		<div class="bounce-loader">
			<div class="loading loading-0"></div>
			<div class="loading loading-1"></div>
			<div class="loading loading-2"></div>
		</div>
		<?php endif; ?>
	</div>
	<?php
}

add_action( 'woocommerce_before_shop_loop_item', 'aurum_shop_loop_item_thumbnail' );

// Remove Item Link
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

// Show Product Title (Loop)
function aurum_shop_loop_item_title() {
	global $product;
	
	$id = $product->get_ID();
	?>
	<div class="item-info">
		<?php do_action( 'aurum_before_shop_loop_item_title' ); ?>
		
		<h3<?php echo ! get_data('shop_add_to_cart_listing') ? ' class="no-right-margin"' : ''; ?>>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>

		<?php if(get_data('shop_product_category_listing')): ?>
		<span class="product-terms">
			<?php the_terms($id, 'product_cat'); ?>
		</span>
		<?php endif; ?>
		
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>	
	<?php
}

add_action( 'woocommerce_shop_loop_item_title', 'aurum_shop_loop_item_title', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 20 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

// Remove price and rating below the product
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );



// Shop Category Item
function aurum_shop_loop_category_thumbnail( $category ) {
	
	$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
	$thumbnail_url = wc_placeholder_img_src();

	if($thumbnail_id)
	{
		$thumbnail_url_custom = wp_get_attachment_image_src( $thumbnail_id, apply_filters('laborator_wc_category_thumbnail_size', 'shop-category-thumb') );

		if($thumbnail_url_custom)
			$thumbnail_url = $thumbnail_url_custom[0];
	}

	echo '<img src="'.$thumbnail_url.'" alt="category-shop" />';
}

add_action( 'woocommerce_before_subcategory_title', 'aurum_shop_loop_category_thumbnail' );

// Shop Category Count
if ( ! get_data('shop_category_count') ) {
	add_filter( 'woocommerce_subcategory_count_html', laborator_immediate_return_fn( '' ) );
}

// Shop Loop Clearing
function aurum_woocommerce_shop_loop_clear_row( $shop_columns, $item_colums ) {
	global $woocommerce_loop;
	
	if ( $shop_columns && $item_colums ) {
		echo $woocommerce_loop['loop'] % $shop_columns == 0 ? '<div class="clear-md"></div>' : '';
		echo $woocommerce_loop['loop'] % 2 == 0 ? '<div class="clear-sm"></div>' : '';
	}
}

add_action( 'aurum_woocommerce_shop_loop_clear_row', 'aurum_woocommerce_shop_loop_clear_row', 10, 2 );



// Account Navigation
function aurum_woocommerce_before_account_navigation() {
	global $current_user;
	
	$account_page_id    = wc_get_page_id( 'myaccount' );
	$account_url        = get_permalink( $account_page_id );
	$logout_url         = wp_logout_url( $account_url );
	
	?>
	<div class="wc-my-account-tabs">
		
		<div class="user-profile">
			<a class="image">
				<?php echo get_avatar( $current_user->ID, 128 ); ?>
			</a>
			<div class="user-info">
				<a class="name" href="<?php echo the_author_meta( 'user_url', $current_user->ID ); ?>"><?php echo $current_user->display_name; ?></a>
				<a class="logout" href="<?php echo $logout_url; ?>"><?php _e( 'Logout', 'aurum' ); ?></a>
			</div>
		</div>
	<?php
}

function aurum_woocommerce_after_account_navigation() {
	?>
	</div>
	<?php
}

add_action( 'woocommerce_before_account_navigation', 'aurum_woocommerce_before_account_navigation' );
add_action( 'woocommerce_after_account_navigation', 'aurum_woocommerce_after_account_navigation' );



// Mini Cart
function aurum_woocommerce_mini_cart_fragments( $fragments ) {
	$fragments['aurumMinicart']     = laborator_woocommerce_get_mini_cart_contents();
	$fragments['aurumCartItems']    = WC()->cart->get_cart_contents_count();
	$fragments['aurumCartSubtotal'] = WC()->cart->get_cart_subtotal();
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'aurum_woocommerce_mini_cart_fragments' );


// Hide title
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

// Display Product ID on Product Meta
function aurum_woocommerce_display_product_id_on_product_meta() {
	?>
	<span>
		<?php _e('Product ID', 'aurum'); ?>: <strong><?php the_ID(); ?></strong>
	</span>
	<?php
}

add_action( 'woocommerce_product_meta_start', 'aurum_woocommerce_display_product_id_on_product_meta' );

// Cart page contents
function aurum_woocommerce_show_cart_title() {
	$cart_items_count = WC()->cart->get_cart_contents_count();
	
	?>
	<div class="page-title">
		<div class="row">
			<div class="<?php echo WC()->cart->coupons_enabled() ? 'col-lg-6 col-md-6 col-sm-6' : 'col-sm-12'; ?>">
				<h1>
					<?php the_title(); ?>
					<small><?php echo sprintf( _n( "You've got one item in the cart", "You've got %d items in the cart", $cart_items_count, 'aurum' ), $cart_items_count); ?></small>
				</h1>
			</div>
	
			<?php
			if ( WC()->cart->coupons_enabled() ) {
				?>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<?php get_template_part( 'tpls/woocommerce-coupon-form' ); ?>
				</div>
				<?php
			} ?>
		</div>
	</div>
	<?php
}

add_action( 'woocommerce_before_cart_table', 'aurum_woocommerce_show_cart_title' );

// Loop cart item title wrap
function aurum_woocommerce_cart_item_name( $name ) {
	return '<h3>' . $name . '</h3>';
}

add_action( 'woocommerce_cart_item_name', 'aurum_woocommerce_cart_item_name' );


// Cart item image
function aurum_woocommerce_cart_item_thumbnail( $image, $cart_item, $cart_item_key ) {
	$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	
	return $_product->get_image( apply_filters( 'lab_wc_cart_image_size', 'shop-thumb-2' ) );
}

add_filter( 'woocommerce_cart_item_thumbnail', 'aurum_woocommerce_cart_item_thumbnail', 10, 3 );

// Cart item subtotal
function aurum_woocommerce_cart_item_subtotal( $price ) {
	return '<div class="price">' . $price . '</div>';
}

add_action( 'woocommerce_cart_item_subtotal', 'aurum_woocommerce_cart_item_subtotal', 10, 3 );


// Single product image wrapper
function aurum_woocommerce_before_single_product_summary_before() {
	$thumbnails_placing = get_data( 'shop_product_thumbnails_placing' );
	$default_gallery_layout = aurum_woocommerce_use_custom_product_image_gallery_layout();
	?>
	<div class="col-lg-6 col-md-6 col-sm-6 product-images-gallery thumbnails-<?php echo $thumbnails_placing; ?>">
	<?php
}

function aurum_woocommerce_before_single_product_summary_after() {
	?>
	</div>
	<?php
}

add_action( 'woocommerce_before_single_product_summary', 'aurum_woocommerce_before_single_product_summary_before', 1 );
add_action( 'woocommerce_before_single_product_summary', 'aurum_woocommerce_before_single_product_summary_after', 10000 );

// Single product row wrapper
function aurum_woocommerce_before_single_product_before() {
	?>
	<div class="row">
	<?php
}

function aurum_woocommerce_before_single_product_after() {
	?>
	</div>
	<?php
}

add_action( 'woocommerce_before_single_product', 'aurum_woocommerce_before_single_product_before', 1 );
add_action( 'woocommerce_after_single_product', 'aurum_woocommerce_before_single_product_after', 10000 );

// Additional variation images plugin does not supports product images layout of Aurum
if ( in_array( 'woocommerce-additional-variation-images/woocommerce-additional-variation-images.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	add_filter( 'aurum_woocommerce_use_custom_product_image_gallery_layout', '__return_false' );
}

// Use Aurum's default product gallery layout
function aurum_woocommerce_use_custom_product_image_gallery_layout() {
	return apply_filters( 'aurum_woocommerce_use_custom_product_image_gallery_layout', true );
}

// Aurum's built in image gallery
function aurum_woocommerce_show_product_images() {
	get_template_part( 'tpls/woocommerce-product-images' );
}

// Replace product image gallery
if ( aurum_woocommerce_use_custom_product_image_gallery_layout() ) {
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
	add_action( 'woocommerce_before_single_product_summary', 'aurum_woocommerce_show_product_images', 25 );
}

// YITH Wishlist Feature
function aurum_woocommerce_yith_wcwl_add_to_wishlist() {
	if ( get_data( 'shop_wishlist_catalog_show' ) && shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) {
		global $product;
		
		$id = $product->get_id();
		$type = $product->get_type();

		echo do_shortcode( "<div class=\"yith-add-to-wishlist\">[yith_wcwl_add_to_wishlist product_id='{$id}' product_type='{$type}' label='' browse_wishlist_text='' already_in_wishslist_text='']</div>" );
	}
}
add_action( 'woocommerce_before_shop_loop_item', 'aurum_woocommerce_yith_wcwl_add_to_wishlist' );


// Default Form Fields Args
function aurum_woocommerce_form_field_args( $field ) {
	$field['class'][] = 'form-group';
	$field['input_class'] = array( 'form-control' );
	$field['placeholder'] = (isset($field['label']) ? $field['label'] : '') . (isset($field['required']) && $field['required'] ? ' *' : '');
	$field['label_class'] = 'hidden';
	
	if ( 'order_comments' == $field['id'] ) {
		$field['label_class'] = '';
		$field['placeholder'] = __('Include custom requirements for this order here', 'aurum');
		$field['input_class'] = array('form-control autogrow');
	}
	
	return $field;
}

add_filter( 'woocommerce_form_field_args', 'aurum_woocommerce_form_field_args' );


// Empty cart page
function aurum_woocommerce_empty_cart_page( $classes ) {
	if ( is_cart() && WC()->cart->is_empty() ) {
		$classes[] = 'wc-cart-empty';
	}
	
	return $classes;
}

add_filter( 'body_class', 'aurum_woocommerce_empty_cart_page' );



// Hide page title in shop page
function aurum_woocommere_show_page_title( $show ) {
	
	if ( function_exists( 'is_sho' ) && ( is_shop() || is_product_category() || is_product_tag() ) ) {
		return false;
	}
	
	return $show;
}

add_filter( 'aurum_show_page_title', 'aurum_woocommere_show_page_title' );


// Product Rating
function aurum_woocommerce_product_get_rating_html( $html, $average, $count ) {
	
	?>	
	<div class="star-rating-icons" class="tooltip" data-toggle="tooltip" data-placement="<?php echo ! is_rtl() ? 'right' : 'left'; ?>" title="<?php echo esc_html( $average ); ?> <?php _e( 'out of 5', 'aurum' ); ?>">
		<?php for($i=1; $i<=5; $i++): ?>
		<i class="entypo-star<?php echo $average >= $i || ($average > 0 && intval($average) == $i - 1 && ($average - intval($average) > 0.49)) ? ' filled' : ''; ?>"></i>
		<?php endfor; ?>
	</div>
	<?php
}

add_filter( 'woocommerce_product_get_rating_html', 'aurum_woocommerce_product_get_rating_html', 10, 3 );
<?php
/**
 *	Aurum WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

global $post, $product, $product_images, $has_gallery;

# start: modified by Arlind Nushi
$product_images = $product->get_gallery_image_ids();
$has_gallery    = count($product_images) > 0;

	# Nivo Lightbox
	wp_enqueue_script('nivo-lightbox');
	wp_enqueue_style('nivo-lightbox-default');


	# Owl Carousel
	wp_enqueue_script('owl-carousel');
	wp_enqueue_style('owl-carousel');


$autoswitch = get_data('shop_single_auto_rotate_image');

if( ! is_numeric($autoswitch))
	$autoswitch = 5;

$shop_magnifier = get_data('shop_magnifier');
$shop_magnifier_zoom_view_size = get_data('shop_magnifier_zoom_view_size');
$shop_magnifier_zoom_level = get_data('shop_magnifier_zoom_level');

$shop_magnifier_zoom_view_size = explode("x", preg_match("/^[0-9]+x[0-9]+$/", $shop_magnifier_zoom_view_size) ? $shop_magnifier_zoom_view_size : "480x395");
$shop_magnifier_zoom_level = is_numeric($shop_magnifier_zoom_level) ? $shop_magnifier_zoom_level : 1.925;

$product_thumbnails_placing = get_data('shop_product_thumbnails_placing');
$horizontal_gallery = $product_thumbnails_placing == 'horizontal'; 
# end: modified by Arlind Nushi

?>
<div class="row shop-item">
	
	<?php if ( $has_gallery && $horizontal_gallery == false ) : ?>
	<div class="col-lg-2 col-md-2 hidden-sm hidden-xs">

		<?php get_template_part( 'tpls/woocommerce-product-image-thumbnails' ); ?>

	</div>
	<?php endif; ?>
	
	<div class="<?php echo $has_gallery && $horizontal_gallery == false ? 'col-lg-10 col-md-10' : 'col-lg-12'; ?>">
			
		<div class="product-images nivo <?php echo $shop_magnifier ? ' magnify-active' : ''; ?>" data-autoswitch="<?php echo 1000 * absint($autoswitch); ?>"<?php if($shop_magnifier): ?> data-zoom-viewsize="<?php echo implode(',', $shop_magnifier_zoom_view_size); ?>" data-zoom-level="<?php echo $shop_magnifier_zoom_level; ?>"<?php endif; ?>>
			<?php
				
			if ( has_post_thumbnail() ) {
				$attachment_count = count( $product->get_gallery_image_ids() );
				$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
				$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop-thumb-main' ), array(
					'title'	 => $props['title'],
					'alt'    => $props['alt'],
				) );
				echo apply_filters(
					'woocommerce_single_product_image_html',
					sprintf(
						'<a href="%s" itemprop="image" class="woocommerce-main-image zoom" zoom item-image-big" data-title="%s" data-lightbox-gallery="shop-gallery">%s</a>',
						esc_url( $props['url'] ),
						esc_attr( $props['caption'] ),
						$image
					),
					$post->ID
				);
				
				
				// Other Gallery Images
				foreach ( $product_images as $attachment_id ) {

					$classes = array( 'zoom' );
					
					$classes[] = 'item-image-big hidden';
		
					$image_class = implode( ' ', $classes );
					$props       = wc_get_product_attachment_props( $attachment_id, $post );
		
					if ( ! $props['url'] ) {
						continue;
					}
		
					echo apply_filters(
						'woocommerce_single_product_image_thumbnail_html',
						sprintf(
							'<a href="%s" class="%s" title="%s" data-lightbox-gallery="shop-gallery">%s</a>',
							esc_url( $props['url'] ),
							esc_attr( $image_class ),
							esc_attr( $props['caption'] ),
							wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop-thumb-main' ), 0 )
						),
						$attachment_id,
						$post->ID,
						esc_attr( $image_class )
					);
				}
				
							
			} else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
			}
			
			?>
		</div>
		
		<?php if ( $has_gallery && $horizontal_gallery ) : ?>
		<div class="horizontal-product-gallery">
	
			<?php get_template_part( 'tpls/woocommerce-product-image-thumbnails' ); ?>
	
		</div>
		<?php endif; ?>
		
	</div>
	
</div>

<?php
/**
 *	Aurum WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();

# start: modified by Arlind Nushi
$thumbnails_to_show = get_data('shop_single_aside_thumbnails_count');

if(has_post_thumbnail() && count($attachment_ids))
{
	array_unshift($attachment_ids, get_post_thumbnail_id());
}

$product_thumbnails_placing = get_data('shop_product_thumbnails_placing');
$horizontal_gallery = $product_thumbnails_placing == 'horizontal'; 
# end: modified by Arlind Nushi

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
	<div class="product-thumbnails"<?php if($horizontal_gallery == false): ?> data-show="<?php echo $thumbnails_to_show; ?>"<?php endif; ?>><?php

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			if ( $loop === 0 || $loop % $columns === 0 ) {
				$classes[] = 'first';
			}

			if ( ( $loop + 1 ) % $columns === 0 ) {
				$classes[] = 'last';
			}

			# start: modified by Arlind Nushi
			$classes[] = 'item-image';

			if($loop == 0)
				$classes[] = 'active';

			if($loop > $thumbnails_to_show - 1)
				$classes[] = 'hidden';
			# end: modified by Arlind Nushi

			$image_class = implode( ' ', $classes );
			$props       = wc_get_product_attachment_props( $attachment_id, $post );

			if ( ! $props['url'] ) {
				continue;
			}

			echo apply_filters(
				'woocommerce_single_product_image_thumbnail_html',
				sprintf(
					'<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>',
					esc_url( $props['url'] ),
					esc_attr( $image_class ),
					esc_attr( $props['caption'] ),
					wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop-thumb-2' ), 0, array(						
						'title'	 => $props['title'],
						'alt'    => $props['alt'],
					) )
				),
				$attachment_id,
				$post->ID,
				esc_attr( $image_class )
			);

			$loop++;
		}

	?></div>
	<?php
}

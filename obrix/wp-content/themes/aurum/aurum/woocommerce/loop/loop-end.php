<?php
/**
 * Product Loop End
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

 /* Note: This file has been altered by Laborator */

?>
		<?php 
		if( ! get_data( 'shop_loop_masonry' ) ) {
			woocommerce_pagination();
		} 
		?>

		</div>
		
		<?php do_action('woocommerce_shop_loop_end'); ?>
		

	</div>

</div>
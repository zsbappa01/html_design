<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $wp_query;

// Search tabs
$search_tabs = laborator_get_search_tabs();

// Found posts
$found_posts = $wp_query->found_posts;

// Show add to cart link for WC_Product
$search_add_to_cart = get_data( 'search_add_to_cart' );

?>
<section class="search-header">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>
					<?php if ( have_posts() ) : ?>
						<?php echo sprintf( _n( '%s result found for <strong>&quot;%s&quot;</strong>', '%s results found for <strong>&quot;%s&quot;</strong>', $found_posts, 'aurum' ), number_format_i18n( $found_posts ), get_search_query() ); ?>
					<?php else: ?>
						<?php echo sprintf( __( 'No search results for <strong>&quot;%s&quot;</strong>', 'aurum' ), get_search_query() ); ?>
					<?php endif; ?>
				</h2>
				<a href="#" class="go-back"><?php _e( '&laquo; Go back', 'aurum' ); ?></a>
				
				<?php if ( have_posts() && apply_filters( 'aurum_search_tabs', true ) ) : ?>
				<nav class="tabs">
					<?php
						
						foreach( $search_tabs as $tab ) :
						
							$title   = $tab['title'];
							$link    = $tab['link'];
							$class   = $tab['active'] ? 'active' : '';
							
							if ( apply_filters( 'aurum_search_tabs_post_count', true ) ) {
								$count = $tab['count'];
								printf( '<a href="%s" class="%s">%s<span>%s</span></a>', $link, $class, $title, $count );
							} else {
								printf( '<a href="%s" class="%s">%s</a>', $link, $class, $title );
							}
							
						endforeach;
						
					?>
				</nav>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>


<section class="search-results-list">
	<div class="container">
		<div class="col-sm-12">

			<ul class="search-results">
			<?php
			
			while ( have_posts() ): the_post();
				$post_cloned = get_post();

				$has_thumbnail = has_post_thumbnail();
				$search_meta = get_the_time( get_option( 'date_format' ) );

				if ( $post->post_type == 'page' ) {
					$search_meta = laborator_page_path( $post );
				}
				elseif ( $post->post_type == 'product' ) {
					if ( function_exists( 'wc_get_product' ) ) {
						$product = wc_get_product( $post );
						$search_meta = $product->get_price_html();
					}
				}
				
				setup_postdata( $post_cloned );

				?>
				<li class="<?php echo $has_thumbnail ? 'has-thumbnail' : ''; ?>">
				<?php
				if ( $has_thumbnail ) {
					echo '<div class="post-thumbnail">';
						echo '<a href="' . get_permalink() . '">';
							the_post_thumbnail( apply_filters( 'aurum_search_thumb', 'thumbnail' ) );
						echo '</a>';
					echo '</div>';
				}
				?>
					<div class="post-details">
						<h3>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<div class="meta">
							<?php echo $search_meta; ?>

							<?php if ( $search_add_to_cart && $post->post_type == 'product' && isset( $product ) ) : ?>

								<?php if ( $product->get_type() == 'simple' ) : ?>
								<br />
								<a href="<?php echo the_permalink() ?>" class="search-add-to-cart ajax-add-to-cart" data-product-id="<?php echo $product->get_id(); ?>" data-placement="right" data-added-to-cart-title="<?php _e( 'Product added to cart!', 'aurum' ); ?>">
									<span class="icon">
										<i class="entypo-plus"></i>
									</span>
									<?php _e( 'Add to cart', 'aurum' ); ?>
								</a>
								<?php endif; ?>

								<?php if ( in_array( $product->get_type(), array( 'variable', 'grouped' ) ) ) : ?>
								<br />
								<a href="<?php echo the_permalink() ?>" class="search-add-to-cart select-opts">
									<span class="icon">
										<i class="entypo-list-add"></i>
									</span>
									<?php _e( 'Select options', 'aurum' ); ?>
								</a>
								<?php endif; ?>

							<?php endif; ?>
						</div>
					</div>

				</li>
				<?php

			endwhile;
			?>
			</ul>

			<?php
			if ( have_posts() ) {
				the_posts_pagination( array(
					'prev_text' => sprintf( '&laquo; %s', __( 'Previous', 'aurum' ) ),
					'next_text' => sprintf( '%s &raquo;', __( 'Next', 'aurum' ) ),
					'mid_size' => 3
				) );
			}
			?>

		</div>
	</div>
</section>
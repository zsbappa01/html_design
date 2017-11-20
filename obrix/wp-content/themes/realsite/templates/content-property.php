<?php $header_image = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'header_image', true ); ?>

<h1 class="page-header">
	<?php if ( empty( $header_image ) ) : ?>
		<?php the_title(); ?>
	<?php else: ?>
		<?php echo __( 'Property detail', 'realia' ); ?>
	<?php endif; ?>

	<div class="page-header-actions">
	    <?php include get_template_directory() . '/templates/compare-action.php'; ?>
        <?php include get_template_directory() . '/templates/favorites-action.php'; ?>

		<span class="action-link has-children social-menu-wrapper" title="<?php echo __( 'Share', 'realia' ); ?>">
			<i class="fa fa-share-alt"></i>

			<ul class="social-menu">
			    <li>
			        <a class="facebook" href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>&amp;title=<?php echo str_replace(' ', '%20', get_the_title()); ?>#sthash.BUkY1jCE.dpuf"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
			            <i class="fa fa-facebook-official"></i>
			            <span class="social-name">Facebook</span>
			        </a>
			    </li>
			    <li>
			        <a class="google-plus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
			            <i class="fa fa-google-plus"></i>
			            <span class="social-name">Google+</span>
			        </a>
			    </li>
			    <li>
			        <a class="twitter" href="https://twitter.com/home?status=<?php echo str_replace( ' ', '%20', get_the_title()); ?>+<?php the_permalink(); ?>#sthash.BUkY1jCE.dpuf"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
			            <i class="fa fa-twitter"></i>
			            <span class="social-name">Twitter</span>
			        </a>
			    </li>
			</ul>			
		</span>
	</div><!-- /.page-header-actions -->
</h1>

<!-- GALLERY -->

<div class="row">
	<?php $gallery = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'gallery', true ); ?>

	<?php if ( ! empty( $gallery ) ) : ?>
	    <div class="col-sm-12 col-md-7">
            <?php if ( ! empty( $gallery ) && is_array( $gallery ) ) : ?>
                <div class="property-detail-section" id="property-detail-section-gallery">

                    <div class="property-detail-gallery-wrapper">
                        <div class="property-detail-gallery">
                            <?php $index = 0; ?>
                            <?php foreach ( $gallery as $id => $src ) : ?>
                                <?php $img = wp_get_attachment_image_src( $id, 'large' ); ?>
                                <?php $src = $img[0]; ?>
                                <a href="<?php echo esc_url( $src ); ?>" rel="property-gallery" data-item-id="<?php echo esc_attr( $index++ ); ?>">
                                    <span class="item-image" data-background-image="<?php echo esc_url( $src ); ?>"></span><!-- /.item-image -->
                                </a>
                            <?php endforeach; ?>
                        </div><!-- /.property-detail-gallery -->

                        <div class="property-detail-gallery-preview" data-count="<?php echo count( $gallery ) ?>">
                            <div class="property-detail-gallery-preview-inner">
                                <?php $index = 0; ?>
                                <?php foreach ( $gallery as $id => $src ) : ?>
                                    <div data-item-id="<?php echo esc_attr( $index++ ); ?>">
                                        <?php $img = wp_get_attachment_image_src( $id, 'thumbnail' ); ?>
                                        <?php $img_src = $img[0]; ?>
                                        <img src="<?php echo $img_src; ?>" alt="">
                                    </div>
                                <?php endforeach; ?>
                            </div><!-- /.property-detail-gallery-preview-inner -->
                        </div><!-- /.property-detail-gallery-preview -->
                    </div><!-- /.property-detail-gallery-wrapper -->
                </div><!-- /.property-detail-section -->
            <?php endif; ?>
	    </div>
	<?php endif; ?>

    <div class="col-sm-12 <?php if ( ! empty( $gallery ) ) : ?>col-md-5<?php else : ?>col-md-12<?php endif; ?>">
        <div class="property-list">
			<h2><?php echo __( 'Property overview', 'realia' ); ?></h2>

            <dl>
            	<?php $price = Realia_Price::get_property_price(); ?>
            	<?php if ( ! empty( $price ) ) : ?>
                	<dt><?php echo __( 'Price', 'realia' )?></dt><dd><?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?></dd>
            	<?php endif; ?>

                <?php $id = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'id', true ); ?>
 				<?php if ( ! empty( $id ) ) : ?>
                	<dt><?php echo __( 'ID', 'realia' ); ?></dt><dd><?php echo esc_attr( $id ); ?></dd>
                <?php endif; ?>

                <?php $type = Realia_Query::get_property_type_name(); ?>
                <?php if ( ! empty ( $type ) ) : ?>
                	<dt><?php echo __( 'Type', 'realia' ); ?></dt><dd><?php echo esc_attr( $type ); ?></dd>
                <?php endif; ?>

                <?php $contract = Realia_Query::get_property_contract_name(); ?>
                <?php if ( ! empty ( $contract ) ) : ?>
                	<dt><?php echo __( 'Contract', 'realia' ); ?></dt><dd><?php echo esc_attr( $contract ); ?></dd>
                <?php endif; ?>

                <?php $location = Realia_Query::get_property_location_name(); ?>
                <?php if ( ! empty ( $location ) ) : ?>
                	<dt><?php echo __( 'Location', 'realia' ); ?></dt><dd><?php echo wp_kses( $location, wp_kses_allowed_html( 'post' ) ); ?></dd>
                <?php endif; ?>

                <?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_area', true ); ?>
                <?php if ( ! empty( $area ) ) : ?>
                	<dt><?php echo __( 'Area', 'realia' ); ?></dt><dd><?php echo esc_attr( $area ); ?> <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?></dd>
                <?php endif; ?>

                <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_baths', true ); ?>
 				<?php if ( ! empty( $baths ) ) : ?>
                	<dt><?php echo __( 'Baths', 'realia' ); ?></dt><dd><?php echo esc_attr( $baths ); ?></dd>
                <?php endif; ?>

                <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_beds', true ); ?>
 				<?php if ( ! empty( $beds ) ) : ?>
                	<dt><?php echo __( 'Beds', 'realia' ); ?></dt><dd><?php echo esc_attr( $beds ); ?></dd>
                <?php endif; ?>

                <?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_garages', true ); ?>
 				<?php if ( ! empty( $garages ) ) : ?>
                	<dt><?php echo __( 'Garages', 'realia' ); ?></dt><dd><?php echo esc_attr( $garages ); ?></dd>
                <?php endif; ?>
            </dl>
        </div><!-- /.property-list -->
    </div>
</div><!-- /.row -->

<!-- DESCRIPTION -->

<?php if ( get_the_content() ) : ?>
    <h2 class="page-header"><?php echo __( 'Description', 'realia' ); ?></h2>

    <div class="property-detail-description">
    	<?php the_content(); ?>
    </div><!-- /.property-detail-description -->
<?php endif; ?>

<!-- AMENITIES -->

<?php $amenities = get_categories( array(
	'taxonomy' 		=> 'amenities',
	'hide_empty' 	=> false,
) ) ; ?>

<?php $hide = get_theme_mod( 'realia_general_hide_unassigned_amenities', false ); ?>
<?php if ( ! empty( $amenities ) ) : ?>
	<h2 class="page-header"><?php echo __( 'Amenities', 'realia' ); ?></h2>

	<div class="property-amenities">
	    <ul>
	    	<?php foreach ( $amenities as $amenity ) : ?>
	    		<?php $has_term = has_term( $amenity->term_id, 'amenities' ); ?>

	    		<?php if ( ! $hide || ( $hide  && $has_term ) ) : ?>
	    			<li <?php if ( $has_term ): ?>class="yes"<?php else : ?>class="no"<?php endif; ?>><?php echo esc_html( $amenity->name ); ?></li>
	    		<?php endif; ?>
	    	<?php endforeach; ?>
	    </ul>
	</div><!-- /.property-amenities -->
<?php endif; ?>

<!-- VIDEO -->
<?php $video = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'video', true ); ?>

<?php if ( ! empty( $video ) ) : ?>
	<h2 class="page-header"><?php echo __( 'Video', 'realia' ); ?></h2>

    <div class="property-video mb30 center">
    	<?php echo apply_filters( 'the_content', '[embed]' . esc_attr( $video ) . '[/embed]' ); ?>
    </div><!-- /.property-floor-plans -->
<?php endif; ?>

<!-- FLOOR PLANS -->
<?php $images = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'plans', true ); ?>

<?php if ( ! empty( $images ) ) : ?>
	<h2 class="page-header"><?php echo __( 'Floor plans', 'realia' ); ?></h2>
    <div class="property-floor-plans mb30">
        <?php foreach ( $images as $id => $url ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" rel="property-plans">
                    <?php echo wp_get_attachment_image( $id, 'thumbnail' ); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </div><!-- /.property-floor-plans -->
<?php endif; ?>

<!-- VALUATION -->
<?php $crime = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'valuation_crime', true ); ?>
<?php $traffic = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'valuation_traffic', true ); ?>
<?php $pollution = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'valuation_pollution', true ); ?>
<?php $education = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'valuation_education', true ); ?>
<?php $health = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'valuation_health', true ); ?>

<?php if ( ! empty( $crime ) || ! empty( $traffic ) || ! empty( $pollution ) || ! empty( $education ) || ! empty( $health ) ) : ?>
	<h2 class="page-header"><?php echo __( 'Valuation', 'realia' ); ?></h2>

	<div class="row">
	    <div class="col-sm-12">
	        <div class="property-valuation">
	            <div class="row">
	                <div class="col-sm-2">
	                    <ul class="property-valuation-keys">
	                    	<?php if ( ! empty( $crime ) ) : ?>
	                        	<li><?php echo __( 'Crime', 'realia' ); ?></li>
	                        <?php endif; ?>

	                        <?php if ( ! empty( $traffic ) ) : ?>
	                        	<li><?php echo __( 'Traffic', 'realia' ); ?></li>
	                        <?php endif; ?>

							<?php if ( ! empty( $pollution ) ) : ?>
	                        	<li><?php echo __( 'Pollution', 'realia' ); ?></li>
							<?php endif; ?>

	                        <?php if ( ! empty( $education ) ) : ?>
	                        	<li><?php echo __( 'Education', 'realia' ); ?></li>
	                        <?php endif; ?>

	                        <?php if ( ! empty( $health ) ) : ?>
	                        	<li><?php echo __( 'Health', 'realia' ); ?></li>
	                        <?php endif; ?>
	                    </ul><!-- /.property-valuation-keys -->
	                </div>

	                <div class="col-sm-8">
	                    <ul class="property-valuation-values">
	                    	<?php if ( ! empty( $crime ) ) : ?>
	                        	<li><span style="width: <?php echo esc_attr( $crime ); ?>%;"><strong><?php echo esc_attr( $crime ); ?> %</strong></span></li>
	                    	<?php endif; ?>

	                    	<?php if ( ! empty( $traffic ) ) : ?>
	                        	<li><span style="width: <?php echo esc_attr( $traffic ); ?>%;"><strong><?php echo esc_attr( $traffic ); ?> %</strong></span></li>
	                    	<?php endif; ?>

	                    	<?php if ( ! empty( $pollution ) ) : ?>
	                        	<li><span style="width: <?php echo esc_attr( $pollution ); ?>%;"><strong><?php echo esc_attr( $pollution ); ?> %</strong></span></li>
	                    	<?php endif; ?>

	                    	<?php if ( ! empty( $education ) ) : ?>
	                        	<li><span style="width: <?php echo esc_attr( $education ); ?>%;"><strong><?php echo esc_attr( $education ); ?> %</strong></span></li>
	                    	<?php endif; ?>

	                    	<?php if ( ! empty( $health ) ) : ?>
	                        	<li><span style="width: <?php echo esc_attr( $health ); ?>%;"><strong><?php echo esc_attr( $health ); ?> %</strong></span></li>
	                    	<?php endif; ?>
	                    </ul><!-- /.property-valuation-values -->
	                </div>
	            </div><!-- /.row -->
	        </div><!-- /.property-valuation -->
	    </div><!-- /.col-* -->
	</div><!-- /.row -->
<?php endif; ?>

<!-- PUBLIC FACILITIES -->
<?php $city = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'public_facilities_city', true ); ?>
<?php $shop = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'public_facilities_shop', true ); ?>
<?php $hospital = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'public_facilities_hospital', true ); ?>
<?php $school = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'public_facilities_school', true ); ?>
<?php $cpt = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'public_facilities_cpt', true ); ?>
<?php $airport = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'public_facilities_airport', true ); ?>

<?php if ( ! empty( $city ) || ! empty( $shop ) || ! empty( $hospital ) || ! empty( $school ) || ! empty( $cpt )  || ! empty( $airport ) ) : ?>
	<h2 class="page-header"><?php echo __( 'Public facilities', 'realia' ); ?></h2>

	<div class="row">
	    <div class="col-sm-12">
	        <div class="property-valuation">
	            <div class="row">
	            	<?php if ( ! empty( $city ) ) : ?>
		            	<div class="col-sm-6 col-md-4">
			            	<div class="module">
					            <div class="module-info center vertical-align min-width">
					                <?php echo esc_attr( $city ); ?>
					            </div><!-- /.module-info -->

					            <div class="module-content vertical-align">
					                <span><?php echo __( 'City center', 'realia' ); ?></span>
					            </div><!-- /.module-content -->
					        </div><!-- /.module -->
					    </div><!-- /.col-* -->
					<?php endif; ?>

					<?php if ( ! empty( $shop ) ) : ?>
		            	<div class="col-sm-6 col-md-4">
			            	<div class="module">
					            <div class="module-info center vertical-align min-width">
					                <?php echo esc_attr( $shop ); ?>
					            </div><!-- /.module-info -->

					            <div class="module-content vertical-align">
					                <span><?php echo __( 'Shop', 'realia' ); ?></span>
					            </div><!-- /.module-content -->
					        </div><!-- /.module -->
					    </div><!-- /.col-* -->
					<?php endif; ?>

					<?php if ( ! empty( $hospital ) ) : ?>
		            	<div class="col-sm-6 col-md-4">
			            	<div class="module">
					            <div class="module-info center vertical-align min-width">
					                <?php echo esc_attr( $hospital ); ?>
					            </div><!-- /.module-info -->

					            <div class="module-content vertical-align">
					                <span><?php echo __( 'Hospital', 'realia' ); ?></span>
					            </div><!-- /.module-content -->
					        </div><!-- /.module -->
					    </div><!-- /.col-* -->
					<?php endif; ?>

					<?php if ( ! empty( $school ) ) : ?>
		            	<div class="col-sm-6 col-md-4">
			            	<div class="module">
					            <div class="module-info center vertical-align min-width">
					                <?php echo esc_attr( $school ); ?>
					            </div><!-- /.module-info -->

					            <div class="module-content vertical-align">
					                <span><?php echo __( 'School', 'realia' ); ?></span>
					            </div><!-- /.module-content -->
					        </div><!-- /.module -->
					    </div><!-- /.col-* -->
					<?php endif; ?>

					<?php if ( ! empty( $cpt ) ) : ?>
		            	<div class="col-sm-6 col-md-4">
			            	<div class="module">
					            <div class="module-info center vertical-align min-width">
					                <?php echo esc_attr( $cpt ); ?>
					            </div><!-- /.module-info -->

					            <div class="module-content vertical-align">
					                <span><?php echo __( 'CPT stop', 'realia' ); ?></span>
					            </div><!-- /.module-content -->
					        </div><!-- /.module -->
					    </div><!-- /.col-* -->
					<?php endif; ?>

					<?php if ( ! empty( $airport ) ) : ?>
		            	<div class="col-sm-6 col-md-4">
			            	<div class="module">
					            <div class="module-info center vertical-align min-width">
					                <?php echo esc_attr( $airport ); ?>
					            </div><!-- /.module-info -->

					            <div class="module-content vertical-align">
					                <span><?php echo __( 'Airport', 'realia' ); ?></span>
					            </div><!-- /.module-content -->
					        </div><!-- /.module -->
					    </div><!-- /.col-* -->
					<?php endif; ?>
	            </div><!-- /.row -->
	        </div><!-- /.property-valuation -->
	    </div><!-- /.col-* -->
	</div><!-- /.row -->
<?php endif; ?>

<?php $location = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'map_location', true ); ?>

<?php if ( ! empty( $location ) && count( $location ) == 2) : ?>
	<h2 class="page-header"><?php echo __( 'Position', 'realia' ); ?></h2>

	<!-- MAP -->
	<div class="map-position">
	    <div id="map-position"
	    	 data-latitude="<?php echo esc_attr( $location['latitude'] ); ?>"
	    	 data-longitude="<?php echo esc_attr( $location['longitude'] ); ?>">
	    </div><!-- /#map-property -->
	</div><!-- /.map-property -->
<?php endif; ?>

<!-- AGENT -->
<?php $agents = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'agents', true);?>

<?php if ( is_array( $agents ) && count($agents) > 0 ) : ?>
	<h2 class="page-header"><?php echo __( 'Assigned agent', 'realia' ); ?></h2>
	<?php $agent_id = array_shift( $agents ); ?>
	<?php query_posts( array(
		'post__in' => array( $agent_id, ),
		'post_type' => 'agent'
	) ); ?>

	<?php if ( have_posts() ) : ?>
		<?php while( have_posts() ) : the_post() ; ?>
			<?php include 'agents/card.php'; ?>
		<?php endwhile; ?>
	<?php endif; ?>

	<?php wp_reset_query(); ?>
<?php endif; ?>

<!-- SIMILAR PROPERTIES -->
<?php Realia_Query::loop_properties_similar(); ?>

<?php if ( have_posts() ) : ?>
	<h2 class="page-header"><?php echo __( 'Similar properties', 'realia' ); ?></h2>

	<div class="row">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="col-sm-4">
				<?php get_template_part( 'templates/properties/box-simple' ); ?>
			</div><!-- /.col-* -->
		<?php endwhile; ?>
	</div><!-- /.row -->
<?php endif?>

<?php wp_reset_query(); ?>

<?php if ( comments_open() || get_comments_number() ): ?>
    <div class="box">
        <?php comments_template( '', true ); ?>
    </div>
<?php endif; ?>
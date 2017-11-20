<?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>

<div class="property-box-simple">
    <div class="property-box-image <?php if ( ! has_post_thumbnail() ) { echo "without-image"; } ?>">
        <a href="<?php the_permalink(); ?>" class="property-box-simple-image-inner">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail(); ?>
            <?php endif; ?>

            <?php $is_featured = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'featured', true ); ?>
            <?php $is_reduced = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'reduced', true ); ?>

            <?php if ( $is_featured && $is_reduced ) : ?>
                <span class="property-badge"><?php echo __( 'Featured', 'realia' ); ?> / <?php echo __( 'Reduced', 'realia' ); ?></span>
            <?php elseif ( $is_featured ) : ?>
                <span class="property-badge"><?php echo __( 'Featured', 'realia' ); ?></span>
            <?php elseif ( $is_reduced ) : ?>
                <span class="property-badge"><?php echo __( 'Reduced', 'realia' ); ?></span>
            <?php endif; ?>

            <?php if ( $is_sticky ) : ?>
                <span class="property-badge property-badge-sticky"><?php echo __( 'TOP', 'realia' ); ?></span>
            <?php endif; ?>
        </a>

	    <?php $enable_favorites = get_theme_mod( 'realia_general_enable_favorites', false ); ?>
	    <?php $enable_compare = get_theme_mod( 'realia_general_enable_compare', false ); ?>

	    <?php if ( ! empty( $enable_favorites ) || ! empty( $enable_compare ) ) : ?>
		    <div class="property-box-simple-actions">
			    <span><?php echo __( 'Actions', 'realia' ); ?></span>
			    <?php include get_template_directory() . '/templates/compare-action.php'; ?>
			    <?php include get_template_directory() . '/templates/favorites-action.php'; ?>
		    </div><!-- /.property-box-simple-actions -->
	    <?php endif; ?>
    </div><!-- /.property-box-image -->

    <div class="property-box-simple-header">
    	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        <?php $price = Realia_Price::get_property_price(); ?>
        <?php if ( ! empty( $price ) ) : ?>
            <h3><?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?></h3>
        <?php endif; ?>    	

        <?php $agent = Realia_Query::get_property_agent(); ?>
        <?php if ( ! empty( $agent ) ) : ?>
            <?php $thumbnail_id = get_post_thumbnail_id( $agent->ID ); ?>

            <?php if ( ! empty( $thumbnail_id ) ) : ?>
                <div class="property-box-simple-header-thumbnail">
                    <a href="<?php echo get_permalink( $agent->ID ); ?>">
                        <?php echo wp_get_attachment_image( $thumbnail_id, 'thumbnail' ); ?>
                    </a>
                </div><!-- /.property-box-simple-header-thumbnail -->
            <?php endif; ?>        		
        <?php endif; ?>
    </div><!-- /.property-box-simple-header -->

    <div class="property-box-simple-meta">
        <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_baths', true ); ?>
        <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_beds', true ); ?>
        <?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_area', true ); ?>

        <ul>
        	<li><span><?php echo __( 'Baths', 'realia' ); ?></span><strong><?php echo ! empty( $baths ) ? esc_attr( $baths ) : '-'; ?></strong></li>
        	<li><span><?php echo __( 'Beds', 'realia' ); ?></span><strong><?php echo ! empty( $beds ) ? esc_attr( $beds ) : '-'; ?></strong></li>
        	<?php $measure = get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?>
        	<li><span><?php echo __( 'Area', 'realia' ); ?></span><strong><?php echo ! empty( $area ) ? esc_attr( $area ) . ' ' . $measure : '-'; ?> </strong></li>
        </ul>    
    </div><!-- /.property-box-simple-meta -->
</div><!-- /.property-box-simple -->
<div class="property-carousel-item">
    <div class="property-simple">
        <a href="<?php the_permalink(); ?>" class="property-simple-image <?php if ( ! has_post_thumbnail() ) { echo "without-image"; } ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail(); ?>

                <?php $is_featured = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'featured', true ); ?>
                <?php $is_reduced = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'reduced', true ); ?>
                <?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>

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
            <?php endif; ?>
        </a>

        <div class="property-simple-content">
            <h2 class="property-simple-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

            <div class="property-simple-location">
                <?php echo Realia_Query::get_property_location_name(); ?>
            </div>

            <?php $price = Realia_Price::get_property_price(); ?>
            <div class="property-simple-price">
                <?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?>
            </div><!-- /.property-simple-price -->
        </div><!-- /.property-simple-content -->
    </div><!-- /.property-simple -->
</div><!-- /.property-carousel-item -->
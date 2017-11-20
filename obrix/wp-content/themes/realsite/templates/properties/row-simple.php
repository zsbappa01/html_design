<?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>

<div class="property-row">
    <a href="<?php the_permalink(); ?>" class="property-row-image">
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

        <?php if ( has_post_thumbnail() ) : ?>
            <?php echo get_the_post_thumbnail(); ?>
        <?php endif; ?>
    </a><!-- /.property-row-image -->

    <div class="property-row-content">
        <h2 class="property-row-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

            <span class="property-row-title-actions">
                <?php include get_template_directory() . '/templates/favorites-action.php'; ?>
                <?php include get_template_directory() . '/templates/compare-action.php'; ?>
            </span><!-- /.property-row-title-actions -->
        </h2>

        <div class="property-row-location">
            <?php echo Realia_Query::get_property_location_name(); ?>
        </div>

        <?php $price = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'price', true ); ?>
        <?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_area', true ); ?>
        <?php $contract = Realia_Query::get_property_contract_name(); ?>
        <?php $type = Realia_Query::get_property_type_name(); ?>

        <div class="property-row-meta">
            <?php if ( ! empty( $type ) ) : ?>
                <div class="property-row-meta-item">
                    <span><i class="fa fa-info"></i></span>
                    <strong><?php echo esc_attr( $type ); ?></strong>
                </div><!-- /.property-box-meta-item -->
            <?php endif; ?>

            <?php if ( ! empty( $price ) ) : ?>
                <div class="property-row-meta-item">
                    <span><i class="fa fa-money"></i></span>
                    <strong><?php echo Realia_Price::get_property_price(); ?></strong>
                </div><!-- /.property-box-meta-item -->
            <?php endif; ?>

            <?php if ( ! empty( $area ) ) : ?>
                <div class="property-row-meta-item">
                    <span><i class="fa fa-arrows"></i></span>
                    <strong><?php echo esc_attr( $area ); ?> <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?></strong>
                </div><!-- /.property-box-meta-item -->
            <?php endif; ?>


            <?php if ( ! empty( $contract ) ) : ?>
                <div class="property-row-meta-item">
                    <strong><?php echo esc_attr( $contract ); ?></strong>
                </div><!-- /.property-box-meta-item -->
            <?php endif; ?>
        </div><!-- /.property-row-meta -->

    </div><!-- /.property-row-content -->
</div>
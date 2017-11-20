<?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>

<div class="property-box">
    <div class="property-box-image <?php if ( ! has_post_thumbnail() ) { echo "without-image"; } ?>">

        <?php $agent = Realia_Query::get_property_agent(); ?>

        <a href="<?php the_permalink(); ?>" class="property-box-image-inner <?php if ( ! empty( $agent ) ) : ?>has-agent<?php endif; ?>">
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
        
        <?php if ( ! empty( $agent ) ) : ?>
            <div class="property-box-caption">
                <div class="property-box-caption-inner">                
                    <?php if ( ! empty( $agent ) ) : ?> 
                        <?php $phone = get_post_meta( $agent->ID, REALIA_AGENT_PREFIX . 'phone', true ); ?>
                        <?php $thumbnail_id = get_post_thumbnail_id( $agent->ID ); ?>

                        <?php if ( ! empty( $thumbnail_id ) ) : ?>
                            <div class="property-box-caption-thumbnail">
                                <a href="<?php echo get_permalink( $agent->ID ); ?>">
                                    <?php echo wp_get_attachment_image( $thumbnail_id, 'thumbnail' ); ?>
                                </a>
                            </div><!-- /.property-box-caption-thumbnail -->
                        <?php endif; ?>

                        <div class="property-box-caption-content">
                            <div class="property-box-caption-title">
                                <a href="<?php echo get_permalink( $agent->ID ); ?>">
                                    <?php echo esc_attr( $agent->post_title ); ?>
                                </a>
                            </div><!-- /.property-box-caption-title -->

                            <?php if ( ! empty( $phone ) ) : ?>
                                <div class="property-box-caption-contact">
                                    <?php echo esc_attr( $phone ); ?>
                                </div><!-- /.property-box-caption-contact -->
                            <?php endif; ?>
                        </div><!-- /.property-box-caption-content -->
                    <?php endif; ?>
                </div><!-- /.property-box-caption-inner -->
            </div><!-- /.property-box-caption -->        
        <?php endif; ?>
    </div><!-- /.property-image -->

    <div class="property-box-content">
        <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_baths', true ); ?>
        <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_beds', true ); ?>
        <?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_garages', true ); ?>

        <div class="property-box-meta">            
            <div class="property-box-meta-item">
                <span><?php echo __( 'Baths', 'realia' ); ?></span>

                <?php if ( ! empty( $baths ) ) : ?>
                    <strong><?php echo esc_attr( $baths ); ?></strong>
                <?php else : ?>
                    <strong>-</strong>
                <?php endif; ?>
            </div><!-- /.property-box-meta-item -->            

            
            <div class="property-box-meta-item">
                <span><?php echo __( 'Beds', 'realia' ); ?></span>

                <?php if ( ! empty( $beds ) ) : ?>
                    <strong><?php echo esc_attr( $beds ); ?></strong>
                <?php else : ?>
                    <strong>-</strong>
                <?php endif; ?>
            </div><!-- /.property-box-meta-item -->                
            
            <div class="property-box-meta-item">
                <span><?php echo __( 'Garages', 'realia' ); ?></span>
                <?php if ( ! empty( $garages ) ) : ?>
                    <strong><?php echo esc_attr( $garages ); ?></strong>
                <?php else : ?>
                    <strong>-</strong>
                <?php endif; ?>
            </div><!-- /.property-box-meta-item -->        
        </div><!-- /.property-box-meta -->
    </div><!-- /.property-box-content -->

    <div class="property-box-bottom">
        <?php $price = Realia_Price::get_property_price(); ?>
        <?php if ( ! empty( $price ) ) : ?>
            <div class="property-box-price">
                <?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?>
            </div><!-- /.property-box-price -->
        <?php endif; ?>

        <a href="<?php the_permalink(); ?>" class="property-box-view">
            <?php echo __( 'View Detail', 'realia'); ?>
        </a><!-- /.property-box-view -->
    </div><!-- /.property-box-bottom -->
</div>
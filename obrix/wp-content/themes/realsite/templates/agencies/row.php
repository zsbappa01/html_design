<div class="agency-row">
    <div class="row">
        <div class="agency-row-image col-sm-3">
            <a href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail(); ?>
                <?php else: ?>
                    <i class="fa fa-suitcase"></i>
                <?php endif; ?>
            </a>
        </div><!-- /.agency-row-image -->

        <div class="agency-row-content col-sm-9 col-md-5">
            <h2 class="agency-row-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="agency-row-subtitle"><?php echo Realia_Query::get_agency_agents()->post_count; ?> <?php echo __( 'agents', 'realia' ); ?></div>
            <hr>
            <?php the_excerpt(); ?>
        </div>

        <div class="agency-row-info col-sm-12 col-md-4">
            <?php $address = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'address', true ); ?>

            <?php if ( ! empty( $address ) ) : ?>
                <div class="mb30">
                    <?php echo nl2br( esc_attr( $address ) ) ;?>
                </div>
            <?php endif; ?>
                       
            <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'phone', true ); ?>
            <?php $email = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'email', true ); ?>
            <?php $web = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'web', true ); ?>

            <?php if ( ! empty( $web ) || ! empty( $phone ) || ! empty( $email ) ) : ?>
                <ul>
                    <?php if ( ! empty( $phone ) ) : ?>
                        <li><i class="fa fa-phone"></i> <?php echo esc_attr( $phone ); ?></li>
                    <?php endif; ?>

                    <?php if ( ! empty( $email ) ) : ?>
                        <li><i class="fa fa-at"></i> <a href="mailto: <?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a></li>
                    <?php endif; ?>

                    <?php if ( ! empty( $web ) ) : ?>
                        <li><i class="fa fa-globe"></i> <a href="<?php echo esc_attr($web); ?>" target="_blank"><?php echo esc_url( $web ); ?></a></li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>            
        </div>
    </div><!-- /.row -->
</div>
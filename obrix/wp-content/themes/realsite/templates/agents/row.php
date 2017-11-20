<div class="agent-row">
    <div class="row">
        <div class="agent-row-image col-sm-3">
            <div class="agent-row-image-inner">
                <a href="<?php the_permalink() ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'thumb' ); ?>
                    <?php endif; ?>
                </a>
            </div><!-- /.agent-row-image-inner -->
        </div><!-- /.agent-row-image -->

        <div class="agent-row-content col-sm-9 col-md-5">
            <h2 class="agent-row-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <?php $properties_count = Realia_Query::get_agent_properties()->post_count; ?>
            <?php if ( ! empty( $properties_count ) ) : ?>
                <div class="agent-row-subtitle">
                    <?php echo esc_attr( $properties_count ); ?> <?php echo __( 'properties', 'realia' ); ?>
                </div><!-- /.agent-row-subtitle -->
            <?php endif; ?>

            <hr>
            <?php the_excerpt(); ?>
        </div>

        <div class="agent-row-info col-sm-12 col-md-4">
           <?php $address = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'address', true ); ?>

            <?php if ( ! empty( $address ) ) : ?>
                <div class="mb30">
                    <?php echo nl2br( esc_attr( $address ) ) ;?>
                </div>
            <?php endif; ?>
                       
            <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
            <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
            <?php $web = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'web', true ); ?>

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
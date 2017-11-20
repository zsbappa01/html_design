<div class="agent-medium">
    <a class="agent-medium-image" href="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'thumb' ); ?>
        <?php endif; ?>
    </a><!-- /.agent-medium-image -->

    <div class="agent-medium-content">
        <h2 class="agent-medium-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <?php $properties_count = Realia_Query::get_agent_properties()->post_count; ?>
        <?php $properties_count = ! empty( $properties_count ) ? $properties_count : 0; ?>
    
        <div class="agent-medium-subtitle">
            <?php echo esc_attr( $properties_count ); ?> <?php echo __( 'properties', 'realia' ); ?>
        </div><!-- /.agent-medium-subtitle -->

        <hr>
        
        <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
        <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
        <?php $web = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'web', true ); ?>

        <?php if ( ! empty( $web ) || ! empty( $phone ) || ! empty( $email ) ) : ?>
            <ul>
                <?php if ( ! empty( $phone ) ) : ?>
                    <li><i class="fa fa-phone"></i> <?php echo esc_attr( $phone ); ?></li>
                <?php endif; ?>

                <?php if ( ! empty( $email ) ) : ?>
                    <li><i class="fa fa-at"></i> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a></li>
                <?php endif; ?>

                <?php if ( ! empty( $web ) ) : ?>
                    <li><i class="fa fa-globe"></i> <a href="<?php echo esc_attr($web); ?>"><?php echo esc_url( $web ); ?></a></li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>    
    </div><!-- /.agent-medium-content -->
</div>
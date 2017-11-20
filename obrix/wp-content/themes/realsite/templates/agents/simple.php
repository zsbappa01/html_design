<div class="agent-simple">
    <a class="agent-simple-image" href="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php echo the_post_thumbnail(); ?>
        <?php endif; ?>
    </a>

    <div class="agent-simple-content">
        <div class="agent-simple-title">
            <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
        </div><!-- /.agent-simple-title -->

        <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
        <?php if ( ! empty( $email ) ) : ?>
            <div class="agent-simple-email">
                <span><i class="fa fa-at"></i> <a href="mailto: <?php echo esc_attr( $email )?>"><?php echo esc_attr( $email ); ?></a></span>
            </div><!-- /.agent-simple-email -->
        <?php endif; ?>

        <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
        <?php if ( ! empty( $phone ) ) : ?>
            <div class="agent-simple-phone">
                <span><i class="fa fa-phone"></i> <?php echo esc_attr( $phone ); ?></span>
            </div><!-- /.agent-simple-phone -->
        <?php endif; ?>
    </div><!-- /.agent-simple-content -->
</div>
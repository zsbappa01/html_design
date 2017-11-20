<?php get_header(); ?>

<div class="row">
    <div class="content col-sm-12">
        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <?php if ( have_posts() ) : ?>
            <h1 class="page-header"><?php echo __( 'Pricing', 'realia' ); ?></h1>
            
            <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="col-sm-6 col-md-3">
                        <?php $highlighted = get_post_meta( get_the_ID(), REALIA_PRICING_PREFIX . 'highlighted', true );?>

                        <div class="pricing-col <?php if ( ! empty( $highlighted ) ) : ?>popular<?php endif; ?>">
                            <div class="pricing-header">
                                <div class="pricing-title"><?php the_title(); ?></div><!-- /.pricing-title -->
                                <div class="pricing-value"><?php echo get_post_meta( get_the_ID(), REALIA_PRICING_PREFIX . 'price', true ); ?></div><!-- /.pricing-value -->

                                <?php $button_text = get_post_meta( get_the_ID(), REALIA_PRICING_PREFIX . 'button_text', true ); ?>
                                <?php $button_link = get_post_meta( get_the_ID(), REALIA_PRICING_PREFIX . 'button_url', true ); ?>
                                <?php if ( ! empty( $button_text ) && ! empty( $button_link ) ) : ?>
                                    <a href="<?php echo esc_attr($button_link); ?>" class="btn"><?php echo esc_attr( $button_text ); ?></a>
                                <?php endif; ?>
                            </div><!-- /.pricing-header -->

                            <?php $items = get_post_meta( get_the_ID(), REALIA_PRICING_PREFIX . 'items', true );?>
                            <?php if ( ! empty( $items ) && is_array( $items ) ) : ?>
                                <div class="pricing-content">
                                    <ul>
                                        <?php foreach ( $items as $item ): ?>                                            
                                            <li><?php echo esc_attr( $item ); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div><!-- /.pricing-content -->
                            <?php endif; ?>
                        </div><!-- /.pricing-col-->
                    </div><!-- /.col-* -->
                <?php endwhile; ?>
            </div><!-- /.faq -->

            <?php aviators_pagination(); ?>
        <?php else : ?>
            <?php get_template_part( 'templates/content-not-found' ); ?>
        <?php endif; ?> 

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
    </div><!-- /.content -->
</div><!-- /.row -->

<?php get_footer(); ?>
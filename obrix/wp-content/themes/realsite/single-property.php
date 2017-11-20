<?php get_header(); ?>

<?php $header_image = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'header_image', true ); ?>
<?php if ( ! empty( $header_image ) ) : ?>
    <?php $src = wp_get_attachment_image_src( key( $header_image ), 'full' ); ?>        

    <div class="header-image" data-background-image="<?php echo esc_attr( $src[0] ); ?>">
        <h1><?php the_title(); ?></h1>

        <?php $location = Realia_Query::get_property_location_name(); ?>
        <?php if ( ! empty ( $location ) ) : ?>
            <h2><?php echo wp_kses( $location, wp_kses_allowed_html( 'post' ) ); ?></h2>
        <?php endif; ?>

        <?php $price = Realia_Price::get_property_price(); ?>
        <?php if ( ! empty( $price ) ) : ?>
            <h3><?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?></h3>
        <?php endif; ?>        
    </div><!-- /.header-image -->
<?php endif; ?>

<?php get_template_part( 'templates/messages' ); ?>

<div class="row">
	<div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'templates/content-property' ); ?>
            <?php endwhile; ?>
        <?php else : ?>
            <?php get_template_part( 'templates/content-not-found' ); ?>
        <?php endif; ?>	

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
	</div><!-- /.content -->

	<?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>
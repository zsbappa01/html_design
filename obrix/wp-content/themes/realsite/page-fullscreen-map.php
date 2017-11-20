<?php
/**
 * Template Name: Fullscreen Map
 */
?>
<?php get_header( 'minimal' ); ?>


<div class="fullscreen-map-wrapper">
    <div class="fullscreen-map-sidebar">
        <div class="fullscreen-map-sidebar-inner">
            <?php dynamic_sidebar( 'fullscreen-map' ); ?>

            <?php Realia_Query::loop_properties_all(); ?>
            <?php Realia_Query::loop_properties_filter(); ?>

            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php include Realia_Template_Loader::locate( 'properties/row' ); ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php Realia_Query::loop_reset(); ?>
        </div><!-- /.fullscreen-map-sidebar-inner -->
    </div><!-- /.fullscreen-map-sidebar -->

    <div class="fullscreen-map-content">
        <div id="fullscreen-map"
             data-transparent-marker-image="<?php echo get_template_directory_uri(); ?>/assets/img/transparent-marker-image.png"></div>
    </div><!-- /.fullscreen-map-content -->
</div><!-- /.fullscreen-map -->

<?php get_footer( 'empty' ); ?>
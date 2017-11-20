<?php if ( method_exists( 'Realia_Utilities', 'protect' ) ) { Realia_Utilities::protect(); } ?>

<?php
/**
 * Template Name: Payment
 */
?>

<?php get_header(); ?>

<div class="row">
    <div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">

        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

		<?php echo do_shortcode( '[realia_submission_payment]' ); ?>
        
        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
    </div><!-- /.content -->

    <?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>
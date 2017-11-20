<?php
/**
 * Template Name: Compare
 */
?>
<?php get_header(); ?>

<div class="row">
	<div class="content col-sm-12">
        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <?php the_content(); ?>

        <?php do_shortcode( '[realia_compare]' ); ?>

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
	</div><!-- /.content -->
</div><!-- /.row -->

<?php get_footer(); ?>
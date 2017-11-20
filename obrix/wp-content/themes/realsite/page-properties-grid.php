<?php
/**
 * Template Name: Properties Grid
 */
?>

<?php get_header(); ?>

<div class="row">
	<div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>
        
        <?php if ( have_posts() ) : the_post(); ?>
            <h1 class="page-header"><?php the_title(); ?></h1>
            
            <?php the_content(); ?>

            <?php query_posts( array(
            	'post_type' 		=> 'property',
            	'post_status' 		=> 'publish',
            	'posts_per_page' 	=> 9,
            	'paged'				=> get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
            ) ); ?>

            <div class="row">
	            <?php while ( have_posts() ) : the_post(); ?>
                    <div class="col-sm-6 col-md-4">
                        <?php get_template_part( 'templates/properties/box-simple' ); ?>                
                    </div>
	            <?php endwhile; ?>
            </div><!-- /.row -->
            <?php aviators_pagination(); ?>

            <?php wp_reset_query(); ?>
        <?php else : ?>
            <?php get_template_part( 'templates/content-not-found' ); ?>
        <?php endif; ?>	

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
	</div><!-- /.content -->

	<?php get_sidebar(); ?>
</div><!-- /.row -->

<?php get_footer(); ?>
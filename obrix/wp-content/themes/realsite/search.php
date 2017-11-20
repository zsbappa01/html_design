<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>

<div class="row">
	<div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <h1 class="page-header">
        	<?php echo __( 'Search results for', 'realia' ) . " '" . get_search_query() . "'"; ?>
        </h1>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
            	<?php if ( get_post_type() == 'property' ) : ?>
            		<?php get_template_part( 'templates/properties/row' ); ?>
            	<?php elseif ( get_post_type() == 'agent' ) : ?>
            		<?php get_template_part( 'templates/agents/row' ); ?>
            	<?php elseif ( get_post_type() == 'agency' ) : ?>
            		<?php get_template_part( 'templates/agencies/row' ); ?>            		
            	<?php else : ?>
            		<?php get_template_part( 'templates/content-post-row' ); ?>
            	<?php endif; ?>
                
            <?php endwhile; ?>
        <?php else : ?>
            <?php get_template_part( 'templates/content-not-found' ); ?>
        <?php endif; ?>	
        
        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
	</div><!-- /.content -->

	<?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>
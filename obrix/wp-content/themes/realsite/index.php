<?php get_header(); ?>

<div class="row">
	<div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <?php if ( have_posts() ) : ?>
            <div class="posts">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'templates/content-post-row' ); ?>
                <?php endwhile; ?>
            </div><!-- /.posts -->

            <?php aviators_pagination(); ?>
        <?php else : ?>
            <?php get_template_part( 'templates/content-not-found' ); ?>
        <?php endif; ?>	

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
	</div><!-- /.content -->

	<?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>
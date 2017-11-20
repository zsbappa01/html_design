<?php
/**
 * Template Name: Blog Grid + Left Sidebar
 */
?>

<?php get_header(); ?>

<?php $counter = 0; ?>
<?php $cols = 3; ?>

    <div class="row">
        <div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9 col-sm-push-4 col-md-push-3<?php else : ?>col-sm-12<?php endif; ?>">
            <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post(); ?>
                    <h1 class="page-header"><?php the_title(); ?></h1>

                    <?php the_content(); ?>

                    <?php query_posts( array(
                        'post_type' 		=> 'post',
                        'posts_per_page' 	=> 9,
                        'paged'             => get_query_var('paged') ? get_query_var('paged') : 1,
                    ) ); ?>

                    <?php if ( have_posts() ) : ?>
                        <div class="posts">
                            <div class="row">
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <div class="col-sm-6 col-md-4">
                                        <?php get_template_part( 'templates/content-post-box' ); ?>
                                    </div><!-- /.col-* -->
                                <?php endwhile; ?>
                            </div><!-- /.row -->
                        </div><!-- /.posts -->

                        <?php aviators_pagination(); ?>
                    <?php else : ?>
                        <?php get_template_part( 'templates/content-not-found' ); ?>
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>

                <?php endwhile; ?>

            <?php aviators_pagination(); ?>
            <?php else : ?>
                <?php get_template_part( 'templates/content-not-found' ); ?>
            <?php endif; ?>

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
        </div><!-- /.content -->

        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <div class="sidebar col-sm-4 col-md-3 col-sm-pull-8 col-md-pull-9">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </div><!-- /.sidebar -->
        <?php endif; ?>

    </div><!-- /.row -->
<?php get_footer(); ?>
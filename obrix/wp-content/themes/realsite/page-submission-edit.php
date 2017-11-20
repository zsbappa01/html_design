<?php if ( method_exists( 'Realia_Utilities', 'protect' ) ) { Realia_Utilities::protect(); } ?>

<?php
/**
 * Template Name: Submission Edit
 */
?>

<?php get_header(); ?>

<div class="row">
	<div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php include 'templates/authenticated-tabs.php'; ?>

        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1 class="page-header">
                        <?php the_title(); ?>    

                        <?php $list_page_id = get_theme_mod( 'realia_submission_list_page', null ); ?>

                        <?php if ( ! empty( $list_page_id ) ) : ?>
                            <a href="<?php echo get_permalink( $list_page_id ); ?>" class="btn btn-lg mb30 pull-right">
                                <?php echo __( 'Back', 'realia' ); ?>
                            </a>               
                        <?php endif; ?>         
                    </h1><!-- /.page-header -->

                    <div class="box submission-form">
                        <?php do_shortcode( '[realia_submission]' ); ?>            
                    </div><!-- /.box -->
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <?php get_template_part( 'templates/content-not-found' ); ?>
        <?php endif; ?>	

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
	</div><!-- /.content -->

	<?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>
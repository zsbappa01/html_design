<?php if ( method_exists( 'Realia_Utilities', 'protect' ) ) { Realia_Utilities::protect(); } ?>

<?php
/**
 * Template Name: Submission Create
 */
?>

<?php get_header(); ?>

<div class="row">
	<div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php include 'templates/authenticated-tabs.php'; ?>

        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <h1 class="page-header">
            <?php the_title(); ?>
            <?php $list_page_id = get_theme_mod( 'realia_submission_list_page', null ); ?>

            <?php if ( ! empty( $list_page_id ) ) : ?>
                <a href="<?php echo get_permalink( $list_page_id ); ?>" class="btn btn-lg mb30 pull-right">
                    <?php echo __( 'Back', 'realia' ); ?>
                </a>               
            <?php endif; ?>              
        </h1>

        <?php if ( have_posts() ) : ?> 
            <div class="box submission-form">
                <?php if ( Realia_Packages::is_allowed_to_add_submission( get_current_user_id() ) ): ?>
                    <?php do_shortcode( '[realia_submission]' ); ?>            
                <?php else : ?>
                    <div class="alert alert-warning">
                        <?php echo __( 'You are not allowed to add property.', 'realia' ); ?>
                    </div><!-- /.alert -->
                <?php endif; ?>
            </div><!-- /.box -->
        <?php else : ?>
            <?php get_template_part( 'templates/content-not-found' ); ?>
        <?php endif; ?>	

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
	</div><!-- /.content -->

	<?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>
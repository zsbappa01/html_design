<?php if ( method_exists( 'Realia_Utilities', 'protect' ) ) { Realia_Utilities::protect(); } ?>

<?php
/**
 * Template Name: Password
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
                    <h1 class="page-header"><?php the_title(); ?></h1>

                    <?php the_content(); ?>

                    <div class="box">
	                    <form method="post" action="<?php the_permalink(); ?>">
	                    	<div class="form-group">
	                    		<label><?php echo __( 'Old password', 'realia' ); ?></label>
	                    		<input class="form-control" type="password" name="old_password" required="required">
	                    	</div><!-- /.form-control -->

	                    	<div class="form-group">
	                    		<label><?php echo __( 'New password', 'realia' ); ?></label>
	                    		<input class="form-control" type="password" name="new_password" required="required" minlength="8">
	                    	</div><!-- /.form-control -->	                    	

	                    	<div class="form-group">
	                    		<label><?php echo __( 'Retype password', 'realia' ); ?></label>
	                    		<input class="form-control" type="password" name="retype_password" required="required" minlength="8">
	                    	</div><!-- /.form-control -->	 

	                    	<button class="btn" type="submit" name="change_password_form"><?php echo __( 'Change Password', 'realia' ); ?></button>                   		                    	
	                    </form>
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
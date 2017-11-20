<?php
/**
 * Template Name: Login / Register
 */
?>

<?php get_header(); ?>

<div class="row">
	<div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1 class="page-header"><?php the_title(); ?></h1>

                    <div class="progressbar">
                        <div class="progressbar-inner">

                            <div class="progressbar-item">
                                <div class="progressbar-item-value">
                                    <div class="progressbar-item-circle">
                                        <span><i class="fa fa-sign-in"></i></span>
                                    </div><!-- /.progressbar-item-circle -->

                                    <div class="progressbar-item-description">
                                        <h4><?php echo __( 'Sign in or register', 'realia' ); ?></h4>

                                        <p>
                                            <?php echo __( 'Create new account or use already existing credentials to access submission.', 'realia')?>
                                        </p>
                                    </div><!-- /.progress-item-description -->                                    
                                </div><!-- /.progress-item-value -->

                                <div class="progressbar-line"></div>
                            </div><!-- /.progress-item -->

                            <div class="progressbar-item">
                                <div class="progressbar-item-value">
                                    <div class="progressbar-item-circle">
                                        <span><i class="fa fa-upload"></i></span>
                                    </div><!-- /.progressbar-item-circle -->

                                    <div class="progressbar-item-description">
                                        <h4><?php echo __( 'Submit property', 'realia' ); ?></h4>

                                        <p>
                                            <?php echo __( 'Upload new property with galleries, attributes and all mandatory data.', 'realia' ); ?>
                                        </p>
                                    </div><!-- /.progress-item-description -->                                    
                                </div><!-- /.progress-item-value -->

                                <div class="progressbar-line"></div>
                            </div><!-- /.progress-item -->                            

                            <div class="progressbar-item">
                                <div class="progressbar-item-value">
                                    <div class="progressbar-item-circle">
                                        <span><i class="fa fa-check"></i></span>
                                    </div><!-- /.progressbar-item-circle -->

                                    <div class="progressbar-item-description">
                                        <h4><?php echo __( 'Get approved', 'realia' ); ?></h4>
                                        <p>
                                            <?php echo __( 'Once it will be reviewed, your property will be published at the front&nbsp;end by admin.', 'realia' ); ?>
                                        </p>
                                    </div><!-- /.progress-item-description -->                                    
                                </div><!-- /.progress-item-value -->
                            </div><!-- /.progress-item -->                                                        
                        </div><!-- /.progress-inner -->
                    </div><!-- /.progress -->

                    <div class="box">
                        <?php the_content(); ?>
                    </div><!-- /.box -->
                    
                    <div class="row">
                        <div class="<?php if ( get_option( 'users_can_register' ) ) : ?>col-sm-12 col-md-6<?php else : ?>col-sm-4 col-sm-offset-4<?php endif; ?>">
                            <div class="box">
                                <h3 class="page-header"><?php echo __( 'Login', 'realia' ); ?></h3>

                                <form method="post" action="<?php the_permalink(); ?>">
                                    <div class="form-group">
                                        <label><?php echo __( 'Username', 'realia' ); ?></label>
                                        <input type="text" name="login" class="form-control" required="required">
                                    </div><!-- /.form-group -->

                                    <div class="form-group">
                                        <label><?php echo __( 'Password', 'realia' ); ?></label>
                                        <input type="password" name="password" class="form-control" required="required">
                                    </div><!-- /.form-group -->       

                                    <button type="submit" class="btn" name="login_form"><?php echo __( 'Log in', 'realia' ); ?></button>                                                               
                                </form>
                            </div><!-- /.box -->
                        </div><!-- /.col-* -->

                        <?php if ( get_option( 'users_can_register ') ) : ?>
                            <div class="col-sm-12 col-md-6">
                                <div class="box">
                                    <h3 class="page-header"><?php echo __( 'Register', 'realia' ); ?></h3>

                                    <form method="post" action="<?php the_permalink(); ?>">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label><?php echo __( 'Username', 'realia' ); ?></label>
                                                    <input type="text" name="name" class="form-control" required="required">
                                                </div><!-- /.form-group -->
                                            </div><!-- /.col-* -->

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label><?php echo __( 'E-mail', 'realia' ); ?></label>
                                                    <input type="email" name="email" class="form-control" required="required">
                                                </div><!-- /.form-group -->  
                                            </div><!-- /.col-* -->
                                        </div><!-- /.row -->

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label><?php echo __( 'Password', 'realia' ); ?></label>
                                                    <input type="password" name="password" class="form-control" required="required">
                                                </div><!-- /.form-group -->
                                            </div><!-- /.col-* -->

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label><?php echo __( 'Retype Password', 'realia' ); ?></label>
                                                    <input type="password" name="password_retype" class="form-control" required="required">
                                                </div><!-- /.form-group -->  
                                            </div><!-- /.col-* -->
                                        </div><!-- /.row -->


                                        <button type="submit" name="register_form" class="btn"><?php echo __( 'Sign Up', 'realia' ); ?></button>                                  
                                        <?php $terms = get_theme_mod( 'realia_submission_terms' ); ?>

                                        <?php if ( ! empty( $terms ) ) : ?>
                                            <div class="form-group terms-conditions-input">
                                                <label>
                                                    <input type="checkbox" name="agree_terms"> 
                                                    <?php echo sprintf( __( 'I agree with <a href="%s">terms & conditions</a>', 'realia' ), get_permalink( $terms ) ); ?>
                                                </label>
                                            </div><!-- /.form-group -->
                                        <?php endif; ?>
                                    </form>                                
                                </div><!-- /.box -->
                            </div><!-- /.col-* -->
                        <?php endif; ?>
                    </div><!-- /.row -->
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
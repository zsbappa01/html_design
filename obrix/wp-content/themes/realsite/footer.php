        <?php dynamic_sidebar( 'sidebar-bottom' ); ?>    

        <?php if ( get_theme_mod( 'realsite_general_enable_customizer' ) ) : ?>
            <?php get_template_part( 'templates/customizer' ); ?>
        <?php endif; ?>
	</div><!-- /.container -->
</div><!-- /.main -->

<div class="footer">
    <?php if ( is_active_sidebar( 'footer-first' ) || is_active_sidebar( 'footer-second' ) || is_active_sidebar( 'footer-third' ) || is_active_sidebar( 'footer-fourth' )) : ?>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-inner">
                    <div class="row">
                        <?php if ( is_active_sidebar( 'footer-first' ) ) : ?>
                            <div class="col-sm-6 col-md-3">
                                <?php dynamic_sidebar( 'footer-first' ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( is_active_sidebar( 'footer-second' ) ) : ?>
                            <div class="col-sm-6 col-md-3">
                                <?php dynamic_sidebar( 'footer-second' ); ?>
                            </div>
                        <?php endif; ?>

                        <hr class="visible-sm">
                        <?php if ( is_active_sidebar( 'footer-third' ) ) : ?>
                            <div class="col-sm-6 col-md-3">
                                <?php dynamic_sidebar( 'footer-third' ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( is_active_sidebar( 'footer-fourth' ) ) : ?>
                            <div class="col-sm-6 col-md-3">
                                <?php dynamic_sidebar( 'footer-fourth' ); ?>
                            </div>
                        <?php endif; ?>                                                            
                    </div><!-- /.row -->
                </div><!-- /.footer-bottom-inner -->
            </div><!-- /.container -->
        </div><!-- /.footer-bottom -->
    <?php endif; ?>

    <?php if ( get_theme_mod( 'footer_top' ) ) : ?>
        <div class="footer-bar">
            <div class="container center">
                <a class="scroll-top"><i class="fa fa-angle-up"></i></a>
            </div><!-- /.container -->
        </div><!-- /.footer-bar -->
    <?php endif; ?>
</div><!-- /.footer -->

</div><!--- /.page-wrapper -->

<?php get_sidebar( 'sidenav' ); ?>

<?php wp_footer(); ?>

</body>
</html>
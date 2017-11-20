        <?php if ( get_theme_mod( 'header_enable_customizer' ) ) : ?>
            <?php get_template_part( 'templates/customizer' ); ?>
        <?php endif; ?>
    </div><!-- /.container -->
</div><!-- /.main -->

<div class="footer">
    <?php if ( get_theme_mod( 'footer_top' ) ) : ?>
        <div class="footer-bar">
            <div class="container center">
                <a class="scroll-top"><i class="fa fa-angle-up"></i></a>
            </div><!-- /.container -->
        </div><!-- /.footer-bar -->
    <?php endif; ?>
</div><!-- /.footer -->

</div><!--- /.page-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
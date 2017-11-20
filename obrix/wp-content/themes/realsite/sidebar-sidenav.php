<?php if ( is_active_sidebar( 'sidenav' ) ) : ?>
    <div class="sidenav">
        <div class="sidenav-inner">
            <div class="sidenav-close">
                <i class="fa fa-times"></i>
            </div><!-- /.sidenav-close -->

            <?php dynamic_sidebar( 'sidenav' ); ?>
            
        </div><!-- /.sidenav-inner -->
    </div><!-- /.sidenav -->
<?php endif; ?>
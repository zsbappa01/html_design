<form method="get" class="form-search site-search" action="<?php echo site_url(); ?>">
    <div class="input-group">
        <input class="search-query form-control" placeholder="<?php echo __( 'Search ...', 'realia' ); ?>" type="text" name="s" id="s" value="<?php if ( isset( $_GET['s'] ) ): ?><?php echo esc_attr( $_GET['s'] ); ?><?php endif; ?>">

         <span class="input-group-btn">
            <button class="btn btn-simple only-icon" type="submit"><i class="fa fa-search"></i></button>
         </span><!-- /.input-group-btn -->
    </div><!-- /.input-group -->
</form><!-- /.site-search -->
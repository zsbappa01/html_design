<?php get_header(); ?>

<div class="row">
	<div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <?php $as_grid = get_theme_mod( 'realia_general_show_property_archive_as_grid', false ); ?>
        
        <?php if ( have_posts() ) : ?>
            <h1 class="page-header"><?php echo __( 'Properties', 'realia' ); ?></h1>

            <div class="properties-sort">
                <form method="get" action="?" id="sort-form">
                    <?php $skip = array(
                        'filter-sort-by', 'filter-sort-order'
                    ); ?>

                    <?php foreach ( $_GET as $key => $value ) : ?>
                        <?php if ( ! in_array( $key, $skip ) ) : ?>
                            <input type="hidden" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_html( $value ); ?>">
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <div class="row">
                        <div class="col-sm-4">
                            <h3 class="page-header"><?php echo __( 'Sorting options', 'realia' ); ?></h3>
                        </div><!-- /.col-* -->

                        <div class="col-sm-4">
                            <select name="filter-sort-by">
                                <option value=""><?php echo __( 'Sort by', 'realia' ); ?></option>
                                <option value="price" <?php if ( ! empty( $_GET['filter-sort-by'] ) && $_GET['filter-sort-by'] == 'price' ): ?>selected="selected"<?php endif; ?>><?php echo __( 'Price', 'realia' ); ?></option>
                                <option value="title" <?php if ( ! empty( $_GET['filter-sort-by'] ) && $_GET['filter-sort-by'] == 'title' ): ?>selected="selected"<?php endif; ?>><?php echo __( 'Title', 'realia' ); ?></option>
                                <option value="published" <?php if ( ! empty( $_GET['filter-sort-by'] ) && $_GET['filter-sort-by'] == 'published' ): ?>selected="selected"<?php endif; ?>><?php echo __( 'Published', 'realia' ); ?></option>
                            </select>
                        </div><!-- /.col-* -->

                        <div class="col-sm-4">
                            <select name="filter-sort-order">
                                <option value=""><?php echo __( 'Order', 'realia' ); ?></option>
                                <option value="asc" <?php if ( ! empty( $_GET['filter-sort-order'] ) && $_GET['filter-sort-order'] == 'asc' ): ?>selected="selected"<?php endif; ?>><?php echo __( 'ASC', 'realia' ); ?></option>
                                <option value="desc" <?php if ( ! empty( $_GET['filter-sort-order'] ) && $_GET['filter-sort-order'] == 'desc' ): ?>selected="selected"<?php endif; ?>><?php echo __( 'DESC', 'realia' ); ?></option>
                            </select>
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </form>
            </div><!-- /.properties-sort -->            

            <?php if ( $as_grid ) : ?>
                <div class="row">
            <?php endif; ?>

            <?php while ( have_posts() ) : the_post(); ?>
                <?php if ( $as_grid ) : ?>
                    <div class="col-sm-6 col-md-4">
                        <?php get_template_part( 'templates/properties/box-simple' ); ?>
                    </div>
                <?php else: ?>
                    <?php get_template_part( 'templates/properties/row' ); ?>
                <?php endif; ?>
            <?php endwhile; ?>

            <?php if ( $as_grid ) : ?>
                </div><!-- /.row -->
            <?php endif; ?>

            <?php aviators_pagination(); ?>
        <?php else : ?>
            <?php get_template_part( 'templates/content-not-found' ); ?>
        <?php endif; ?>	

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
	</div><!-- /.content -->

	<?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>
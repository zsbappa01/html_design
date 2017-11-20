<?php get_header(); ?>

<div class="row">
	<div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <?php if ( have_posts() ) : ?>
        	<h1 class="page-header"><?php echo __( 'FAQ', 'realia' ); ?></h1>

			<div class="faq">
				<?php while ( have_posts() ) : the_post(); ?>
				    <div class="faq-item">
				        <div class="faq-item-question">
				            <h2><?php the_title(); ?></h2>
				        </div><!-- /.faq-item-question -->

				        <div class="faq-item-answer">
				            <?php the_content(); ?>
				        </div><!-- /.faq-item-answer -->
				    </div><!-- /.faq-item -->
			    <?php endwhile; ?>
			</div><!-- /.faq -->

            <?php aviators_pagination(); ?>
        <?php else : ?>
            <?php get_template_part( 'templates/content-not-found' ); ?>
        <?php endif; ?>	

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
	</div><!-- /.content -->

	<?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>

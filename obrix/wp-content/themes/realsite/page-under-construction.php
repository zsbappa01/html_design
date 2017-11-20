<?php
/**
 * Template Name: Under Construction
 */
?>

<?php get_header( 'empty' ); ?>

<?php if ( have_posts() ): the_post(); ?>
	<div class="under-construction">
		<div class="under-construction-top">
			<div class="under-construction-top-inner">
				<h1><?php the_title(); ?></h1>
			</div><!-- /.under-construction-top-inner -->
		</div><!-- /.under-contruction-top -->

		<div class="under-construction-bottom">
			<div class="under-construction-bottom-inner">
				<?php the_content(); ?>
			</div><!-- /.under-construction-bottom-inner -->
		</div><!-- /.under-contruction-bottom -->
	</div><!-- /.under-construction -->
<?php endif; ?>

<?php get_footer( 'empty' ); ?>
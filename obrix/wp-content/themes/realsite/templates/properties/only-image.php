<div class="property-only-image">
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'thumb' ); ?>
		</a>
	<?php endif; ?>
</div><!-- /.property-only-image -->
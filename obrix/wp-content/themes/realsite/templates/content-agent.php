<h1 class="page-header"><?php the_title(); ?></h1>

<?php $content = get_the_content(); ?>

<?php if ( ! empty( $content ) ) : ?>
	<div class="mb30 text-grey">
		<?php the_content(); ?>
	</div>
<?php endif; ?>

<?php include 'agents/card.php'; ?>

<?php Realia_Query::loop_agent_properties(); ?>

<?php if ( have_posts() ) : ?>
	<h2 class="page-header"><?php echo __( 'Assigned properties', 'realia' ); ?></h2>

	<div class="row">
		<?php while( have_posts() ) : the_post(); ?>
			<div class="col-sm-6 col-md-4">
				<?php include 'properties/box.php'; ?>
			</div>
		<?php endwhile; ?>
	</div><!-- /.row -->
<?php endif;?>

<?php wp_reset_query(); ?>

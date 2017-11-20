<h1 class="page-header"><?php the_title(); ?></h1>

<?php $content = get_the_content(); ?>

<div class="overview-box">
	<h2><?php echo __( 'Agency overview', 'realia' ); ?></h2>

	<?php $address = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'address', true ); ?>
	<?php if ( ! empty( $address ) ) : ?>
		<?php echo nl2br( esc_attr( $address ) ); ?>
	<?php endif; ?>

    <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'phone', true ); ?>
    <?php $email = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'email', true ); ?>
    <?php $web = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'web', true ); ?>

    <?php if ( ! empty( $web ) || ! empty( $phone ) || ! empty( $email ) ) : ?>
        <ul>
            <?php if ( ! empty( $phone ) ) : ?>
                <li><i class="fa fa-phone"></i> <?php echo esc_attr( $phone ); ?></li>
            <?php endif; ?>

            <?php if ( ! empty( $email ) ) : ?>
                <li><i class="fa fa-at"></i> <a href="mailto: <?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a></li>
            <?php endif; ?>

            <?php if ( ! empty( $web ) ) : ?>
                <li><i class="fa fa-globe"></i> <a href="<?php echo esc_attr($web); ?>"><?php echo esc_url( $web ); ?></a></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?> 	
</div><!-- /.box -->

<?php if ( ! empty( $content ) ) : ?>
	<div class="mb30 table-cell text-grey">
		<?php the_content(); ?>
	</div>
<?php endif; ?>

<?php $location = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'location', true ); ?>

<?php if ( ! empty( $location ) && count( $location ) == 2 ) : ?>
	<h2 class="page-header"><?php echo __( 'Position on Map', 'realia' ); ?></h2>

	<!-- MAP -->
	<div class="map-position">
	    <div id="map-position" 
	    	 data-latitude="<?php echo esc_attr( $location['latitude'] ); ?>" 
	    	 data-longitude="<?php echo esc_attr( $location['longitude'] ); ?>">
	    </div><!-- /#map-property -->
	</div><!-- /.map-property -->
<?php endif; ?>

<?php Realia_Query::loop_agency_agents(); ?>

<?php if ( have_posts() ) : ?>	
	<h2 class="page-header"><?php echo __( 'Assigned agents', 'realia' ); ?></h2>

	<div class="row">
		<?php while( have_posts() ) : the_post(); ?>
			<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-0">
				<?php include 'agents/simple.php'; ?>
			</div>
		<?php endwhile; ?>
	</div><!-- /.row -->
<?php endif;?>

<?php wp_reset_query(); ?>
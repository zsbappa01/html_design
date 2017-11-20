<div class="infobox">
	<a class="infobox-image" href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( 'thumbnail' ); ?>

		<?php $price = Realia_Price::get_property_price(); ?>
		<?php if ( ! empty( $price ) ) : ?>
			<div class="infobox-content-price"><?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?></div>
		<?php endif; ?>		
	</a>

	<div class="infobox-content">
		<div class="infobox-content-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>

		<div class="infobox-content-body">		
			<div class="infobox-content-body-location">
				<?php echo Realia_Query::get_property_location_name(); ?>
			</div>

			<?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_area', true ); ?>
			<?php if ( ! empty( $area ) ) : ?>
				<div class="infobox-content-body-area">
					<span><?php echo __( 'Area', 'realia' ); ?>:</span> 
					<strong><?php echo esc_attr( $area ); ?> <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?></strong>
				</div>
			<?php endif; ?>		

			<?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_beds', true ); ?>
			<?php if ( ! empty( $beds ) ) : ?>
				<div class="infobox-content-body-beds">
					<span><?php echo __( 'Beds', 'realia' ); ?>:</span> 
					<strong><?php echo esc_attr( $beds ); ?></strong>
				</div>
			<?php endif; ?>

			<?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'attributes_baths', true ); ?>
			<?php if ( ! empty( $baths ) ) : ?>
				<div class="infobox-content-body-baths">
					<span><?php echo __( 'Baths', 'realia' ); ?>:</span> 
					<strong><?php echo esc_attr( $baths ); ?></strong>
				</div>
			<?php endif; ?>							
		</div>
	</div>

	<?php $agent = Realia_Query::get_property_agent(); ?>

	<?php if ( ! empty( $agent ) ) : ?>
		<div class="infobox-contact">
			<div class="infobox-contact-title">
				<a href="<?php echo get_the_permalink( $agent->ID ); ?>">
					<?php echo get_the_title( $agent->ID ); ?>
				</a>
			</div>

			<div class="infobox-contact-body">
				<?php $address = get_post_meta( $agent->ID, REALIA_AGENT_PREFIX . 'address', true ); ?>
				<?php if ( ! empty( $address ) ) : ?>
					<?php echo wp_kses( $address, wp_kses_allowed_html( 'post' ) ); ?>
				<?php endif; ?>

				<?php $phone = get_post_meta( $agent->ID, REALIA_AGENT_PREFIX . 'phone', true ); ?>
				<?php if ( ! empty( $phone ) ) : ?>
					<i class="fa fa-phone"></i> <?php echo esc_attr( $phone ); ?>
				<?php endif; ?>
			</div>

			<a href="#" class="close"><i class="fa fa-close"></i></a>
		</div>
	<?php endif; ?>
</div>
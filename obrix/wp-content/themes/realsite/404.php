<?php get_header( 'simple' ); ?>

<div class="row">
	<div class="content col-sm-12">
		<div class="not-found">
			<div class="not-found-title">
				<strong>404</strong> <span><?php echo __( 'Page not found', 'realia' ); ?></span>
			</div>

			<div class="not-found-content">
				<h1 class="not-found-subtitle"><?php echo __( 'You have several options', 'realia' ); ?></h1>

				<div class="row">
					<div class="col-sm-5">
						<ul class="not-found-list">
							<li><?php echo sprintf( __( 'Return back to <a href="%s">homepage</a>', 'realia' ), site_url() ); ?></li>
							<li><?php echo sprintf( __( 'Check our most recent <a href="%s">properties</a>', 'realia' ), get_post_type_archive_link( 'property' ) );?></li>
							<li><?php echo __( 'Use the <a href="#header">menu</a> above to change the location', 'realia' ); ?></li>
							<li><?php echo __( 'Contact us via our contact page', 'realia' ); ?></li>
							<li><?php echo __( 'Click on the location at right', 'realia' ); ?></li>
						</ul>
					</div><!-- /.col-* -->

					<?php $terms = get_terms( 'locations', array( 'hide_empty' => false ) ); ?>
					<?php if ( ! empty( $terms ) ) : ?>
						<div class="col-sm-7">
							<div class="module">
								<div class="module-content">
									<h4><?php echo __( 'Choose a location', 'realia' ); ?></h4>
									<div class="row">									
										<ul class="not-found-links">
											<?php foreach ( $terms as $term ): ?>
												<li class="col-sm-4">
													<a href="<?php echo get_term_link( $term, 'locations' ); ?>"><?php echo esc_html( $term->name ); ?></a>
												</li>
											<?php endforeach; ?>
										</ul>
									</div><!-- /.row -->		
								</div><!-- /.module-content -->				
							</div><!-- /.module -->
						</div><!-- /.col-* -->
					<?php endif; ?>
				</div><!-- /.row -->
			</div><!-- /.not-found-content -->
		</div>
	</div><!-- /.content -->
</div><!-- /.row -->

<?php get_footer( 'simple' ); ?>
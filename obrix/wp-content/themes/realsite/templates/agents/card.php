<?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
<?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
<?php $web = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'web', true ); ?>

<?php if ( ! empty( $_POST ) && array_key_exists('contact-form', $_POST  ) ) : ?>
	<?php
	$is_form_filled = ! empty( $_POST['email'] ) && ! empty( $_POST['subject'] ) && ! empty( $_POST['message'] );
	$is_recaptcha = Realia_Recaptcha::is_recaptcha_enabled();
	$is_recaptcha_valid = array_key_exists('g-recaptcha-response', $_POST ) ? Realia_Recaptcha::is_recaptcha_valid( $_POST['g-recaptcha-response'] ) : false;
	?>

	<?php if ( ! ( $is_recaptcha && ! $is_recaptcha_valid ) && $is_form_filled ) : ?>
		<?php $headers = sprintf( "From: %s <%s>\r\n Content-type: text/html", $_POST['email'], $_POST['email'] ); ?>
		<?php $result = wp_mail( $email, $_POST['subject'], $_POST['message'], $headers ); ?>

		<?php if ( $result ) : ?>
			<div class="alert alert-success"><?php echo __( 'Your message has been successfully sent.', 'realia' ); ?></div>
		<?php else: ?>
			<div class="alert alert-warning"><?php echo __( 'An error occured when sending an email.', 'realia' ); ?></div>
		<?php endif; ?>
	<?php else: ?>
		<div class="alert alert-warning"><?php echo __( 'Form has been not filled correctly.', 'realia' ); ?></div>
	<?php endif; ?>
<?php endif; ?>

<div class="module">
	<div class="module-content">
		<div class="agent-card">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-0 mb30">
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" class="agent-card-image">
							<?php echo get_the_post_thumbnail(); ?>
						</a><!-- /.agent-card-image -->
					<?php else: ?>
						<a href="<?php the_permalink(); ?>" class="agent-card-image">
						</a><!-- /.agent-card-image-empty -->
					<?php endif; ?>
				</div>

				<div class="col-sm-12 col-md-3">
					<h2><?php the_title(); ?></h2>

					<div class="agent-card-info">
						<?php $address = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'address', true ); ?>
						<?php if ( ! empty( $address ) ) : ?>
							<div class="mb30">
								<?php echo nl2br( $address ); ?>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $web ) || ! empty( $phone ) || ! empty( $email ) ) : ?>
							<ul>
								<?php if ( ! empty( $phone ) ) : ?>
									<li><i class="fa fa-phone"></i> <?php echo esc_attr( $phone ); ?></li>
								<?php endif; ?>

								<?php if ( ! empty( $email ) ) : ?>
									<li><i class="fa fa-at"></i> <a href="mailto: <?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a></li>
								<?php endif; ?>

								<?php if ( ! empty( $web ) ) : ?>
									<li><i class="fa fa-globe"></i> <a href="<?php echo esc_attr($web); ?>" target="_blank"><?php echo esc_url( $web ); ?></a></li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div><!-- /.agent-card-info -->
				</div>

				<?php if ( ! empty( $email ) ) : ?>
					<div class="col-sm-12 col-md-5 mb30">
						<h2><?php echo __( 'Contact Form', 'realia' ); ?></h2>

						<div class="agent-card-form">
							<form method="post" action="?">
								<div class="form-group">
									<input type="text" class="form-control" name="subject" placeholder="<?php echo __( 'Subject', 'realia' ); ?>">
								</div><!-- /.form-group -->

								<div class="form-group">
									<input type="email" class="form-control" name="email" placeholder="<?php echo __( 'E-mail', 'realia' ); ?>">
								</div><!-- /.form-group -->

								<div class="form-group">
									<textarea class="form-control" name="message" placeholder="<?php echo __( 'Message', 'realia' ); ?>" style="overflow: hidden; word-wrap: break-word; height: 68px;"></textarea>
								</div><!-- /.form-group -->

								<?php if ( Realia_Recaptcha::is_recaptcha_enabled() ) : ?>
									<div id="recaptcha-agent-card" class="recaptcha" data-sitekey="<?php echo get_theme_mod( 'realia_recaptcha_site_key' ); ?>"></div>
								<?php endif; ?>

								<button class="btn pull-right" name="contact-form"><?php echo __( 'Send message', 'realia' ); ?></button>
							</form>
						</div><!-- /.agent-card-form -->
					</div>
				<?php endif; ?>
			</div>
		</div><!-- /.agent-card-->
	</div><!-- /.module-content -->
</div><!-- /.module -->

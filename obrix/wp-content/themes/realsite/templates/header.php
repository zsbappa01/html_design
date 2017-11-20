<div id="header" class="header header-standard">
	<?php if ( is_user_logged_in() ) : ?>
        <?php $menu = wp_nav_menu( array(
            'theme_location' 	=> 'topbar-authenticated',
            'fallback_cb' 		=> false,
            'container_class' 	=> 'menu-container',
            'echo'				=> false,
        ) ); ?>
	<?php else: ?>
        <?php $menu = wp_nav_menu( array(
            'theme_location' 	=> 'topbar-anonymous',
            'fallback_cb' 		=> false,
            'container_class' 	=> 'menu-container',
            'echo'				=> false,
        ) ); ?>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'header-topbar-left') || is_active_sidebar( 'header-topbar-right' ) || $menu ) : ?>
		<div class="header-topbar">
			<div class="container">
				<?php if ( is_active_sidebar( 'header-topbar-left' ) ) : ?>
					<div class="header-topbar-left">
						<?php dynamic_sidebar( 'header-topbar-left' ); ?>
					</div><!-- /.header-topbar-left -->
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'header-topbar-right' ) || ! empty( $menu ) ) : ?>
					<div class="header-topbar-right">
						<?php dynamic_sidebar( 'header-topbar-right' ); ?>
						<?php echo wp_kses( $menu, wp_kses_allowed_html( 'post' ) ); ?>
					</div><!-- /.header-topbar-right -->
				<?php endif; ?>
			</div><!-- /.container -->
		</div><!-- /.header-topbar -->
	<?php endif; ?>

	<?php $variant = get_theme_mod( 'realsite_header_variant', 'standard' ); ?>

	<?php if ( ! empty( $_GET['header-variant'] ) ) : ?>
		<?php $variant = $_GET['header-variant']; ?>
	<?php endif; ?>

	<div class="container">
		<div class="header-inner <?php if ( ! empty( $variant ) ) : ?>header-variant-<?php echo esc_attr( $variant );?><?php endif; ?>">
			<?php if ( $variant == 'information' ) : ?>
				<div class="header-main">
					<div class="navbar-toggle">
						<i class="fa fa-bars"></i>
					</div>

					<div class="header-title">
						<a href="<?php echo site_url(); ?>" title="<?php echo __( 'Home', 'realia' ); ?>">
							<?php if ( get_theme_mod( 'realsite_general_logo' ) ) : ?>
								<img src="<?php echo get_theme_mod( 'realsite_general_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
							<?php endif; ?>

							<?php if ( ! get_theme_mod( 'realsite_header_disable_title' ) ) : ?>
								<span><?php bloginfo( 'name' ); ?></span>
							<?php endif; ?>
						</a>
					</div><!-- /.header-title -->

					<?php if ( is_active_sidebar( 'sidenav' ) ) : ?>
						<div class="sidenav-toggle">
	                		<i class="fa fa-bars"></i>
	                	</div><!-- /.sidenav-toggle -->
                	<?php endif; ?>

					<div class="header-info">
						<?php for ( $i = 3; $i >= 1; $i-- ) : ?>
							<?php $icon = get_theme_mod( 'realsite_header_information_' . $i . '_icon', null ); ?>
							<?php $title = get_theme_mod( 'realsite_header_information_' . $i . '_title', null ); ?>
							<?php $subtitle = get_theme_mod( 'realsite_header_information_' . $i . '_subtitle', null ); ?>

							<?php if ( ! empty( $title ) || ! empty( $subtitle ) ) : ?>
								<div class="header-info-col">
									<?php if ( ! empty( $icon ) ) : ?>
										<div class="header-info-icon">
											<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
										</div>
									<?php endif; ?>

									<div class="header-info-item">
										<?php if ( ! empty( $title ) ) : ?>
											<strong><?php echo esc_attr( $title ); ?></strong>
										<?php endif; ?>

										<?php if ( ! empty( $subtitle ) ) : ?>
											<span><?php echo esc_attr( $subtitle ); ?></span>
										<?php endif; ?>
									</div>
								</div><!-- /.header-info-col -->
							<?php endif; ?>
						<?php endfor ?>
					</div><!-- /.header-info -->
				</div><!-- /.header-main -->

				<?php if ( has_nav_menu( 'main' ) ) : ?>
					<div class="header-navigation-wrapper clearfix">
						<div class="header-main-title">
							<?php bloginfo( 'name' ); ?>
						</div><!-- /.header-main-title -->

						<div class="header-navigation">
							<?php $menu = wp_nav_menu( array(
								'fallback_cb'		=> '',
								'theme_location'    => 'main',
								'container_class'	=> 'primary-menu-container',
								'menu_class'        => 'nav nav-pills',
								'walker'            => new Aviators_Menu(),
							) ); ?>
						</div><!-- /.header-navigation -->
					</div><!-- /.header-navigation-wrapper -->
				<?php endif; ?>
			<?php elseif ( $variant == 'search' ) : ?>
				<div class="header-main">
                    <div class="navbar-toggle">
                        <i class="fa fa-bars"></i>
                    </div>

					<div class="header-title">
						<a href="<?php echo site_url(); ?>" title="<?php echo __( 'Home', 'realia' ); ?>">
							<?php if ( get_theme_mod( 'realsite_general_logo' ) ) : ?>
								<img src="<?php echo get_theme_mod( 'realsite_general_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
							<?php endif; ?>

							<span><?php bloginfo( 'name' ); ?></span>
						</a>
					</div><!-- /.header-title -->

					<?php if ( is_active_sidebar( 'sidenav' ) ) : ?>
						<div class="sidenav-toggle">
	                		<i class="fa fa-bars"></i>
	                	</div><!-- /.sidenav-toggle -->
                	<?php endif; ?>

					<div class="header-search">
	                    <form method="get" action="<?php bloginfo( 'url' ); ?>">
	                        <div class="input-group">
	                            <input type="text" name="s" placeholder="<?php echo __( 'Search Properties', 'realia' ); ?>" class="form-control">

	                            <span class="input-group-btn">
	                                <button class="btn" type="submit"><i class="fa fa-search"></i></button>
	                            </span>
	                        </div><!-- /.form-group -->
	                    </form>
                	</div><!-- /.header-search -->
				</div><!-- /.header-main -->

				<?php if ( has_nav_menu( 'main' ) ) : ?>
					<div class="header-navigation-wrapper clearfix">
                        <div class="header-main-title">
                            <?php bloginfo( 'name' ); ?>
                        </div><!-- /.header-main-title -->

						<div class="header-navigation">
							<?php $menu = wp_nav_menu( array(
								'fallback_cb'		=> '',
								'theme_location'    => 'main',
								'container_class'	=> 'primary-menu-container',
								'menu_class'        => 'nav nav-pills',
								'walker'            => new Aviators_Menu(),
							) ); ?>
						</div><!-- /.header-navigation -->
					</div><!-- /.header-navigation-wrapper -->
				<?php endif; ?>
			<?php elseif ( $variant == 'ad-space' ) : ?>
				<div class="header-main">
                    <div class="navbar-toggle">
                        <i class="fa fa-bars"></i>
                    </div>

					<div class="header-title">
						<a href="<?php echo site_url(); ?>" title="<?php echo __( 'Home', 'realia' ); ?>">
							<?php if ( get_theme_mod( 'realsite_general_logo' ) ) : ?>
								<img src="<?php echo get_theme_mod( 'realsite_general_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
							<?php endif; ?>

							<?php if ( ! get_theme_mod( 'realsite_header_disable_title' ) ) : ?>
								<span><?php bloginfo( 'name' ); ?></span>
							<?php endif; ?>
						</a>
					</div><!-- /.header-title -->

					<?php if ( is_active_sidebar( 'sidenav' ) ) : ?>
						<div class="sidenav-toggle">
	                		<i class="fa fa-bars"></i>
	                	</div><!-- /.sidenav-toggle -->
                	<?php endif; ?>

                	<?php if ( is_active_sidebar( 'header-ad-space' ) ) : ?>
						<div class="header-ad hidden-xs">
		                    <?php dynamic_sidebar( 'header-ad-space' ); ?>
	                	</div><!-- /.header-search -->
                	<?php endif; ?>
				</div><!-- /.header-main -->

				<?php if ( has_nav_menu( 'main' ) ) : ?>
					<div class="header-navigation-wrapper clearfix">
                        <div class="header-main-title">
                            <?php bloginfo( 'name' ); ?>
                        </div><!-- /.header-main-title -->

						<div class="header-navigation">
							<?php $menu = wp_nav_menu( array(
								'fallback_cb'		=> '',
								'theme_location'    => 'main',
								'container_class'	=> 'primary-menu-container',
								'menu_class'        => 'nav nav-pills',
								'walker'            => new Aviators_Menu(),
							) ); ?>
						</div><!-- /.header-navigation -->
					</div><!-- /.header-navigation-wrapper -->
				<?php endif; ?>
			<?php else : ?>
				<div class="header-main">
                    <div class="navbar-toggle">
                        <i class="fa fa-bars"></i>
                    </div>

					<div class="header-title">
						<a href="<?php echo site_url(); ?>" title="<?php echo __( 'Home', 'realia' ); ?>">
							<?php if ( get_theme_mod( 'realsite_general_logo' ) ) : ?>
								<img src="<?php echo get_theme_mod( 'realsite_general_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
							<?php endif; ?>

							<?php if ( ! get_theme_mod( 'realsite_header_disable_title' ) ) : ?>
								<span><?php bloginfo( 'name' ); ?></span>
							<?php endif; ?>
						</a>
					</div><!-- /.header-title -->

					<?php if ( is_active_sidebar( 'sidenav' ) ) : ?>
						<div class="sidenav-toggle">
	                		<i class="fa fa-bars"></i>
	                	</div><!-- /.sidenav-toggle -->
                	<?php endif; ?>

                    <div class="header-navigation-wrapper">
                        <div class="header-main-title">
                            <?php bloginfo( 'name' ); ?>
                        </div><!-- /.header-main-title -->

                        <div class="header-navigation">
                            <?php $menu = wp_nav_menu( array(
                                'fallback_cb'		=> '',
                                'theme_location'    => 'main',
								'container_class'	=> 'primary-menu-container',
                                'menu_class'        => 'nav nav-pills',
                                'walker'            => new Aviators_Menu(),
                            ) ); ?>
                        </div><!-- /.header-navigation -->
                    </div><!-- /.header-navigatiokn-wrapper -->
				</div><!-- /.header-main -->
			<?php endif; ?>

			<?php if ( get_theme_mod( 'realsite_general_action' ) ) : ?>
				<a class="header-action" href="<?php echo get_permalink( get_theme_mod( 'realsite_general_action' ) ); ?>">
					<?php $text = get_theme_mod( 'realsite_general_action_text', 'fa-plus' ); ?>
					<?php $icon = ! empty( $text ) ? $text : 'fa-plus'; ?>
					<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
				</a><!-- /.header-action -->
			<?php endif; ?>
		</div><!-- /.header-inner -->
	</div><!-- /.container -->
</div><!-- /.header-->

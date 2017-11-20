<ul class="nav nav-tabs" role="tablist">
	<?php $submission_page = get_theme_mod( 'realia_submission_list_page', null ); ?>
	<?php if ( ! empty( $submission_page ) ) : ?>
    	<li <?php if ( get_the_ID() == $submission_page ) : ?>class="active"<?php endif; ?>>
    		<a href="<?php echo get_permalink( $submission_page ); ?>">
    			<?php echo get_the_title( $submission_page ); ?>
    		</a>
    	</li>
	<?php endif; ?>

    <?php $favorites_page = get_theme_mod( 'realia_general_favorites_page', null ); ?>
    <?php if ( ! empty( $favorites_page ) ) : ?>
        <li <?php if ( get_the_ID() == $favorites_page ) : ?>class="active"<?php endif; ?>>
            <a href="<?php echo get_permalink( $favorites_page ); ?>">
                <?php echo get_the_title( $favorites_page ); ?>
            </a>
        </li>
    <?php endif; ?>

    <?php $transactions_page = get_theme_mod( 'realia_submission_transactions_page', null ); ?>
    <?php if ( ! empty( $transactions_page ) ) : ?>
        <li <?php if ( get_the_ID() == $transactions_page ) : ?>class="active"<?php endif; ?>>
            <a href="<?php echo get_permalink( $transactions_page ); ?>">
                <?php echo get_the_title( $transactions_page ); ?>
            </a>
        </li>
    <?php endif; ?>

	<?php $profile_page = get_theme_mod( 'realia_general_profile_page', null ); ?>
	<?php if ( ! empty( $profile_page ) ): ?>
    	<li <?php if ( get_the_ID() == $profile_page ) : ?>class="active"<?php endif; ?>>
    		<a href="<?php echo get_permalink( $profile_page ); ?>">
    			<?php echo get_the_title( $profile_page ); ?>
    		</a>
    	</li>
    <?php endif; ?>

    <?php $password_page = get_theme_mod( 'realia_general_password_page', null ); ?>
    <?php if ( ! empty( $password_page ) ) : ?>
    	<li <?php if ( get_the_ID() == $password_page ) : ?>class="active"<?php endif; ?>>
    		<a href="<?php echo get_the_permalink( $password_page ); ?>">
    			<?php echo get_the_title( $password_page ); ?>
    		</a>
    	</li>
	<?php endif; ?>
</ul>
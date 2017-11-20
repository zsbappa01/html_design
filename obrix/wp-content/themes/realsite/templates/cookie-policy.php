<div class="cookie-policy">
	<div class="cookie-policy-inner">		

		<?php echo sprintf( 
			__( 'By using this website you agree with <a href="%s">cookie policy</a>.', 'realia' ), 
			get_permalink( $cookie_policy_page_id ) ); ?>		

		<a href="#" class="btn-simple cookie-policy-confirm"><?php echo __( 'I agree', 'realia' )?></a>
	</div><!-- /.cookie-policy-inner -->
</div><!-- /.cookie-policy -->
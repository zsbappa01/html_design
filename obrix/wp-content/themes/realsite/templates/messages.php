<?php if ( ! empty( $_SESSION['messages'] ) && is_array( $_SESSION['messages'] ) ) : ?>
	<?php $_SESSION['messages'] = Realia_Utilities::array_unique_multidimensional( $_SESSION['messages'] );?>

	<div class="alerts">
		<?php foreach ( $_SESSION['messages'] as $message ) : ?>
			<div class="alert alert-<?php echo esc_attr( $message[0] ); ?>">
				<?php echo wp_kses( $message[1], wp_kses_allowed_html( 'post' ) ); ?>
			</div><!-- /.alert -->
		<?php endforeach; ?>
	</div><!-- /.alerts -->
	
	<?php unset( $_SESSION['messages'] ); ?>
<?php endif; ?>

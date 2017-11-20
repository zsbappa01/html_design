<?php if ( ! empty( $messages ) && is_array( $messages ) ) : ?>
	<?php foreach( $messages as $message ): ?>
	    <?php echo esc_attr( $message ); ?><br/>
	<?php endforeach; ?>
<?php endif; ?>
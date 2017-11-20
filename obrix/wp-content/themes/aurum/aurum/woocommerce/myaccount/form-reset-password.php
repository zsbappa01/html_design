<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices(); ?>


<?php // start: modified by Arlind ?>
<div class="row">
	<div class="col-sm-6">
		<div class="bordered-block form-forgot-passwd-env">

			<h2>
				<?php _e('Forgot Password', 'aurum'); ?>
			</h2>
<?php // end: modified by Arlind ?>
			
			<form method="post" class="woocommerce-ResetPassword lost_reset_password">
			
				<p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'woocommerce' ) ); ?></p>
			
				<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="password_1" id="password_1" placeholder="<?php esc_html_e( 'New password', 'woocommerce' ); ?> *" />
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="password_2" id="password_2" placeholder="<?php esc_html_e( 'Re-enter new password', 'woocommerce' ); ?> *" />
				</p>
			
				<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
				<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />
			
				<div class="clear"></div>
			
				<?php do_action( 'woocommerce_resetpassword_form' ); ?>
			
				<p class="woocommerce-form-row form-row">
					<input type="hidden" name="wc_reset_password" value="true" />
					<input type="submit" class="woocommerce-Button button btn btn-primary" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>" />
				</p>
			
				<?php wp_nonce_field( 'reset_password' ); ?>
			
			</form>

<?php // start: modified by Arlind ?>
		</div>
	</div>
</div>
<?php // end: modified by Arlind ?>		
<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php // start: modified by Arlind ?>
<div class="row">
	<div class="col-lg-12">
		<div class="page-title">
			<h1>
				<?php _e( 'Log In', 'aurum' ); ?>
				<small><?php _e( 'Manage your account and see your orders', 'aurum' ); ?></small>
			</h1>
		</div>
	</div>
</div>
<?php // end: modified by Arlind ?>

<div class="row form-login-env">
	
<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

	<div class="col-sm-6">
	
		<div class="bordered-block">
			
			<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>

			<form class="woocommerce-form woocommerce-form-login login" method="post">
	
				<?php do_action( 'woocommerce_login_form_start' ); ?>
	
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="username" id="username" placeholder="<?php esc_attr_e( 'Username or email address', 'woocommerce' ); ?> *" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<input class="woocommerce-Input woocommerce-Input--text input-text form-control" type="password" name="password" id="password" placeholder="<?php esc_attr_e( 'Password', 'woocommerce' ); ?>" />
				</p>
	
				<?php do_action( 'woocommerce_login_form' ); ?>
	
				<p class="form-row form-group">
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
					
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline" for="rememberme"><span><?php _e( 'Remember me', 'woocommerce' ); ?></span></label>
				</p>
				<p class="woocommerce-LostPassword lost_password pull-right">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
				</p>
				
				<input type="submit" class="woocommerce-Button button btn btn-primary" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
	
				<?php do_action( 'woocommerce_login_form_end' ); ?>
	
			</form>
			
		</div>
		
	</div>

	<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
	<div class="col-sm-6">
	
		<div class="bordered-block">
			
			<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>
	
			<form method="post" class="register">
	
				<?php do_action( 'woocommerce_register_form_start' ); ?>
	
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
	
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="username" id="reg_username" placeholder="<?php esc_attr_e( 'Username', 'woocommerce' ); ?> *" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
					</p>
	
				<?php endif; ?>
	
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="email" id="reg_email" placeholder="<?php esc_attr_e( 'Email address', 'woocommerce' ); ?> *" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" />
				</p>
	
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
	
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control" placeholder="<?php esc_attr_e( 'Password', 'woocommerce' ); ?> *" name="password" id="reg_password" />
					</p>
	
				<?php endif; ?>
	
				<?php do_action( 'woocommerce_register_form' ); ?>
	
				<p class="woocommerce-FormRow form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<input type="submit" class="woocommerce-Button button btn btn-primary" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
				</p>
	
				<?php do_action( 'woocommerce_register_form_end' ); ?>
	
			</form>
			
		</div>
		
	</div>
	<?php endif; ?>



<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
</div>
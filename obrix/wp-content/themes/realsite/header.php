<!DOCTYPE html>
<html <?php language_attributes() ?> data-ng-app="realia">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="page-wrapper">
	<?php include 'templates/header.php'; ?>

	<div class="main">
		<?php dynamic_sidebar( 'sidebar-top-fullwidth' ); ?>

		<div class="container">  
			<?php dynamic_sidebar( 'sidebar-top' ); ?>
			
			<?php if ( ! is_singular( 'property' ) ) : ?>
				<?php get_template_part( 'templates/messages' ); ?>
			<?php endif; ?>
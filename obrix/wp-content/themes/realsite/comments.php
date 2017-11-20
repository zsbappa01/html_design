<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'realia' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php echo __( 'Comment navigation', 'realia' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'realia' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'realia' ) ); ?></div>
			</nav><!-- /#comment-nav-above -->
		<?php endif; ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      	=> 'ol',
					'short_ping' 	=> true,
					'avatar_size'	=> 50,
					'callback'		=> 'aviators_comment',
				) );
			?>
		</ol><!-- /.comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php echo __( 'Comment navigation', 'realia' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'realia' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'realia' ) ); ?></div>
			</nav><!-- /#comment-nav-below -->
		<?php endif; ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php echo __( 'Comments are closed.', 'realia' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php comment_form( array(
		'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Your comment"></textarea></p>'
	) ); ?>
</div><!-- /#comments -->

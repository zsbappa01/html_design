<?php echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>
<?php $input_titles = ! empty( $instance['input_titles'] ) ? $instance['input_titles'] : 'labels'; ?>

<?php if ( ! empty( $instance['fullwidth'] ) ) : ?>
    <div class="container">
<?php endif; ?>

<?php if ( ! empty( $instance['title'] ) ) : ?>
    <?php echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); ?>
    <?php echo esc_attr( $instance['title'] ); ?>
    <?php echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); ?>
<?php endif; ?>

<div class="center">
    <?php if ( Realia_Reviews::get_post_reviews_count() > 0 ) : ?>
        <div class="review-rating-total" data-fontawesome data-score="<?php echo Realia_Reviews::get_post_total_rating(); ?>" data-path="<?php echo plugins_url(); ?>/realia/libraries/raty/images"></div>

        <small class="review-rating-total-description">
            <?php echo __( 'Ratings', 'realia' ); ?>:
            <?php echo Realia_Reviews::get_post_total_rating(); ?>/5 <?php echo __( 'from', 'realia' ); ?> <?php echo Realia_Reviews::get_post_reviews_count(); ?> <?php echo __( 'users', 'realia' ); ?>
        </small>
    <?php else : ?>
        <small class="review-rating-total-empty"><?php echo __( 'No ratings, yet.', 'realia' ); ?></small>
    <?php endif; ?>
</div><!-- /.center -->

<?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>
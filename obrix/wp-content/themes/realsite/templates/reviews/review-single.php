<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'reviews' ); ?> id="review-<?php comment_ID() ?>">
    <div class="review clearfix">
        <div class="review-avatar">
            <?php if ( ! empty( $args['avatar_size'] ) ) : ?>
                <?php echo wp_kses( get_avatar( $review, $args['avatar_size'] ), wp_kses_allowed_html( 'post' ) ); ?>
            <?php endif; ?>
        </div><!-- /.review-image -->

        <div class="review-content">
            <div class="review-meta">
                <strong class="review-author"><?php comment_author(); ?></strong>
                <span class="review-date"><?php echo esc_attr( get_comment_date() ); ?></span>
                <?php $rating = get_comment_meta( get_comment_ID(), 'rating', true ); ?>

                <?php if ( ! empty( $rating ) ) : ?>
                    <div class="review-rating-wrapper">

                        <span class="review-rating" data-fontawesome data-path="<?php echo plugins_url(); ?>/realia/libraries/raty/images" data-score="<?php echo esc_attr( $rating ); ?>" data-starOn="fa fa-star" data-starHalf="fa fa-star-half-o" data-starOff="fa fa-star-o"></span>
                    </div>
                <?php endif; ?>
            </div><!-- /.review-meta -->

            <div class="review-body">
                <?php comment_text(); ?>
            </div><!-- /.review-body -->

            <?php if ( $review->comment_approved == '0' ) : ?>
                <em class="review-awaiting-moderation">
                    <?php __( 'Your review is awaiting moderation.', 'realia' ); ?>
                </em><!-- /.review-awaiting-moderation -->
            <?php endif; ?>
        </div><!-- /.review-content -->
    </div><!-- /.review -->

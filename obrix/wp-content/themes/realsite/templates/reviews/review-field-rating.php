<p class="review-form-rating" data-fontawesome data-path="<?php echo plugins_url(); ?>/realia/libraries/raty/images">
    <label for="rating"><?php echo __( 'Your Rating', 'realia' ); ?></label>

    <input class="hidden"
           type="text"
           id="rating"
           name="rating"
           value="<?php echo esc_attr( ! empty( $commenter['comment_rating'] ) ? $commenter['comment_rating'] : null ) ; ?>" size="30">
</p>
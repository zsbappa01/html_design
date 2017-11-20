<?php $attachment_id = get_post_thumbnail_id( get_the_ID() ); ?>
<?php $image = wp_get_attachment_image_src( $attachment_id, 'post-thumbnail' ); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class("post-single"); ?>>
        <?php if ( ! post_password_required() && ! is_attachment() ) : ?>
            <?php if ( get_the_post_thumbnail() ) : ?>
                <div class="post-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo get_the_post_thumbnail(); ?>
                    </a>
                </div><!-- /.post-image -->
            <?php endif; ?>
        <?php endif; ?>

    <div class="post-body <?php if ( ! get_the_post_thumbnail() ): ?>no-thumbnail<?php endif; ?>">
        <div class="post-meta">
            <div class="post-meta-author">
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
            </div><!-- /.post-meta-author -->

            <div class="post-date">
                <?php echo get_the_date(); ?>
            </div><!-- /.post-date -->

            <div class="post-comments">
                <?php echo get_comments_number(); ?>
            </div><!-- /.post-comments -->

            <div class="post-meta-tags">
                <?php the_tags( '', '' ); ?>
            </div><!-- /.post-meta-tags -->

        </div><!-- /.post-meta -->

        <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
        </header><!-- /.post-comments -->

        <div class="post-content">
            <?php the_content(); ?>
        </div><!-- /.post-content -->

        <?php if ( comments_open() || get_comments_number() ): ?>
            <?php comments_template(); ?>
        <?php endif; ?>
    </div>
    </article><!-- #post -->

<?php wp_link_pages( array(
    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'realia' ) . '</span>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
) );

<?php $attachment_id = get_post_thumbnail_id( get_the_ID() ); ?>
<?php $image = wp_get_attachment_image_src( $attachment_id, 'post-thumbnail' ); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class("post-row"); ?>>
        <?php if ( ! post_password_required() && ! is_attachment() ) : ?>
            <?php if ( get_the_post_thumbnail() ) : ?>
                <div class="post-image <?php if ( $image[1] <= 300 ) : ?>post-image-left<?php endif; ?>">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'post-row' ); ?>
                    </a>
                </div><!-- /.post-image -->
            <?php endif; ?>
        <?php endif; ?>

        <div class="post-body <?php if ( has_post_thumbnail() && $image[1] <= 300 ) : ?>has-image-left<?php endif; ?> <?php if ( ! get_the_post_thumbnail() ): ?>no-thumbnail<?php endif; ?>">

            <header class="entry-header">
                <h1 class="post-title">
                    <a href="<?php echo get_permalink(get_the_ID()); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h1>
            </header><!-- /.post-comments -->

            <div class="post-excerpt">
                <?php the_excerpt(); ?>
            </div><!-- .entry-content -->

            <a class="read-more" href="<?php echo get_permalink(get_the_ID()); ?>">
                <?php echo __( 'Read More', 'realia' ); ?>
            </a>

            <div class="post-meta">
                <div class="post-meta-author">
                    <?php echo get_the_author_link(); ?>
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

        </div>
    </article><!-- #post -->

<?php wp_link_pages( array(
    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'realia' ) . '</span>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
) );

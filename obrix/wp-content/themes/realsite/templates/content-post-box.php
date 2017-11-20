<?php $attachment_id = get_post_thumbnail_id( get_the_ID() ); ?>
<?php $image = wp_get_attachment_image_src( $attachment_id, 'post-thumbnail' ); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class("post-box"); ?>>
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

            <div class="post-categories">
                <?php $categories = wp_get_post_categories( get_the_ID() ); ?>
                <?php $counter = 1; ?>
                <?php foreach ( $categories as $category_id ) : ?>
                    <?php $category = get_category( $category_id ); ?>
                    <a href="<?php echo get_category_link( $category )?>"><?php echo esc_attr( $category->name ); ?></a><?php if ( $category_id != end( $categories ) ) : ?>, <?php endif; ?>
                    <?php if ( $counter++ == 2 && count( $categories ) > 2 ) : ?>...<?php break; ?><?php endif; ?>
                <?php endforeach; ?>
            </div>

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

                <div class="post-date">
                    <?php echo get_the_date(); ?>
                </div><!-- /.post-date -->

                <div class="post-comments">
                    <?php echo get_comments_number(); ?>
                </div><!-- /.post-comments -->

            </div><!-- /.post-meta -->

        </div><!-- /.post-body -->
    </article><!-- #post -->

<?php wp_link_pages( array(
    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'realia' ) . '</span>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
) );

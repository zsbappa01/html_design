<?php if ( method_exists( 'Realia_Utilities', 'protect' ) ) { Realia_Utilities::protect(); } ?>

<?php
/**
 * Template Name: Profile
 */
?>

<?php get_header(); ?>

<div class="row">
    <div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php include 'templates/authenticated-tabs.php'; ?>

        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1 class="page-header"><?php the_title(); ?></h1>

                    <?php the_content(); ?>

                    <div class="box">
                        <?php $user = wp_get_current_user(); ?>
                        <?php $data = get_userdata( $user->ID ); ?>

                        <form method="post" action="<?php the_permalink(); ?>">
                           <div class="form-group">
                                <label><?php echo __( 'Nickname', 'realia' ); ?></label>
                                <input type="text" name="nickname" class="form-control" value="<?php echo esc_attr( $data->nickname ); ?>" required="required">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label><?php echo __( 'E-mail', 'realia' ); ?></label>
                                <input type="email" name="email" class="form-control" value="<?php echo esc_attr( $user->user_email ); ?>"  required="required">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label><?php echo __( 'First name', 'realia' ); ?></label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo esc_attr( $data->first_name ); ?>">
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label><?php echo __( 'Last name', 'realia' ); ?></label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo esc_attr( $data->last_name ); ?>">
                            </div><!-- /.form-group -->

                            <button type="submit" class="btn" name="change_profile_form"><?php echo __( 'Change Profile', 'realia' ); ?></button>
                        </form>
                    </div><!-- /.box -->
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <?php get_template_part( 'templates/content-not-found' ); ?>
        <?php endif; ?> 
        
        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
    </div><!-- /.content -->

    <?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>
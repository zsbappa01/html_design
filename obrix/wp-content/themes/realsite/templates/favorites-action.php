<?php $enable_favorites = get_theme_mod( 'realia_general_enable_favorites', false ); ?>

<?php if ( ! empty( $enable_favorites ) ) : ?>
    <?php if ( is_user_logged_in() ) : ?>            	
        <span data-ng-controller="FavoritesAddController">                                                        
            <a title="<?php echo __( 'Remove from favorites', 'realia' ); ?>" 
               class="favorites-action action-link favorites-added" 
               data-ng-click="remove(<?php the_ID(); ?>)" 
               data-ng-show='is_included(<?php the_ID(); ?>)'>
                <i class="fa fa-heart"></i>
            </a>

          	<a title="<?php echo __( 'Add to favorites', 'realia' ); ?>" 
                   class="favorites-action action-link" 
                   data-ng-click="add(<?php the_ID(); ?>)" 
                   data-ng-show='!is_included(<?php the_ID(); ?>)'>
          		<i class="fa fa-heart-o"></i>
          	</a>
        </span>
    <?php else: ?>
        <?php $link = Realia_Utilities::get_link_for_login(); ?>
        <span>
        <?php if ( $link ) : ?>
            <a href="<?php echo esc_attr( $link ); ?>" class="favorites-action action-link" title="<?php echo __( 'Add to favorites', 'realia' ); ?>">
                <i class="fa fa-heart-o"></i>
            </a>                                  
        <?php else: ?>
            <a title="<?php echo __( 'Add to favorites', 'realia' ); ?>" class="favorites-action action-link favorites-added" >
                <i class="fa fa-heart-o"></i>
            </a>      
        <?php endif; ?>               
      </span>
    <?php endif; ?>
<?php endif; ?>
<?php $enable_compare = get_theme_mod( 'realia_general_enable_compare', false ); ?>

<?php if ( ! empty( $enable_compare ) ) : ?>
    <span data-ng-controller="CompareAddController">
    	<a title="<?php echo __( 'Add to compare list', 'realia' ); ?>" class="compare-add action-link" data-ng-click="add(<?php the_ID(); ?>)">
    		<i class="fa fa-exchange"></i>
    	</a>
    </span>
<?php endif; ?>
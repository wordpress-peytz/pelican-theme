<?php
$primary_category_term = \Pelican\Theme\TemplateFunctions\PrimaryCategory::get_primary_category( $post->ID );
?>

<?php if ( $primary_category_term ) : ?>
	<div class="post-header__category-wrapper label-wrapper">
		<a href="<?php echo get_term_link( (int) $primary_category_term->term_id ); ?>" class="post-header__category label" title="<?php echo sprintf( __( 'Go to %s', THEMEDOMAIN ), $primary_category_term->name ); ?>">
			<?php echo $primary_category_term->name; ?>
		</a>
	</div>
<?php endif; ?>

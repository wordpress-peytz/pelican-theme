<?php if ( has_category() ) : ?>
<div class="post-meta__categories">
	<span class="post-meta__categories-title"><?php _e( 'Categories:', THEMEDOMAIN ); ?></span>
	<?php the_category(); ?>
</div>
<?php endif; ?>

<?php
$post_id    = get_the_ID();
$css_prefix = ( is_singular() ) ? 'post-header__' : 'listed-post__';

if ( get_post_type( $post_id ) == 'page' ) {
	$hero_id      = apply_filters( THEMEDOMAIN . '_hero_post_id', $post_id );
	$hero_excerpt = apply_filters( THEMEDOMAIN . '_hero_excerpt', get_post_meta( $hero_id, THEMEDOMAIN . '_introtext', true ) );
}
?>

<div class="<?php echo $css_prefix; ?>excerpt" itemprop="description">

	<?php if ( get_post_type( $post_id ) == 'page' && ! empty( $hero_excerpt ) ) : ?>
		<p><?php echo $hero_excerpt; ?></p>
	<?php else : ?>
		<?php if ( has_excerpt() ) : ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>
	<?php endif; ?>

</div> <!-- .excerpt -->

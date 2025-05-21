<?php
/**
 * Displays existing comments and the comment form.
 * Usually not used - 3rd party plugins are better (facebook, disqus, livefyre)
 *
 * @package WordPress
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( post_password_required() ) {
	return;
}
?>

<section class="comments">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments__title"><?php comments_number( __( '<span class="comments__count">No</span> Responses', THEMEDOMAIN ), __( '<span class="comments__count">One</span> Response', THEMEDOMAIN ), __( '<span class="comments__count">%</span> Responses', THEMEDOMAIN ) ); ?></h2>

		<ol class="comments__list">
			<?php
			wp_list_comments(
				[
					'type'  => 'comment',
					'style' => 'ol',
				]
			);
			?>
		</ol>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="comments__none"><?php _e( 'Comments are closed.', THEMEDOMAIN ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php comment_form(); ?>

</section>

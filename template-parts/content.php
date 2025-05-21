<?php
/**
 * Template part used as a fallback if no other template parts match
 *
 * @package WordPress
 */
?>

<article id="article-<?php the_ID(); ?>" <?php post_class( 'post-wrapper' ); ?> <?php echo is_singular( 'post' ) ? 'itemscope itemtype="https://schema.org/NewsArticle"' : ''; ?>>

	<section class="post-header" aria-label="<?php echo __( 'Page content head section', THEMEDOMAIN ); ?>">

		<?php do_action( THEMEDOMAIN . '_before_article_content' ); ?>

	</section>

	<section class="post-content">

		<?php the_content(); ?>

	</section>

	<section class="post-footer" aria-label="<?php echo __( 'Content footer section', THEMEDOMAIN ); ?>">

		<?php do_action( THEMEDOMAIN . '_after_article_content' ); ?>

	</section>

</article>

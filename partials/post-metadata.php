<div class="post-meta">
	<div class="post-meta__author">
		<span class="post-meta__author-title"><?php _e( 'By', THEMEDOMAIN ); ?></span>
		<span class="post-meta__author-value"><?php the_author_meta( 'display_name', $post->post_author ); ?></span>
	</div>

	<span class="post-meta__separator">|</span>

	<div class="post-meta__date">
		<time class="post-meta__date-value time" datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished">
			<?php echo get_the_date( get_option( 'date_format' ) ); ?>
		</time>
	</div>
</div>

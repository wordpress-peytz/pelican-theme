<?php
	$title     = urlencode( get_the_title() );
	$permalink = urlencode( get_permalink() );
?>

<div class="share-socialmedia">

	<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $permalink; ?>" class="socialmedia__link socialmedia__link--linkedin" title="<?php _e( 'Share on Linkedin', THEMEDOMAIN ); ?>" rel="noreferrer noopener" target="_blank">
		<span class="screen-reader-text"><?php _e( 'Share on Linkedin', THEMEDOMAIN ); ?></span>
		<span class="icon-linkedin"></span>
	</a>

	<a href="https://x.com/intent/tweet?text=<?php echo $title . '&url=' . $permalink; ?>" class="share-socialmedia__link share-socialmedia__link--x" title="<?php _e( 'Share on X', THEMEDOMAIN ); ?>" rel="noreferrer noopener" target="_blank">
		<span class="screen-reader-text"><?php _e( 'Share on X', THEMEDOMAIN ); ?></span>
		<span class="share-socialmedia__icon icon-x"></span>
	</a>

	<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?>" class="socialmedia__link socialmedia__link--facebook" title="<?php _e( 'Share on Facebook', THEMEDOMAIN ); ?>" rel="noreferrer noopener" target="_blank">
		<span class="screen-reader-text"><?php _e( 'Share on Facebook', THEMEDOMAIN ); ?></span>
		<span class="icon-facebook"></span>
	</a>

	<a href="mailto:?subject=<?php echo $title; ?>&amp;body=<?php echo $permalink; ?>" class="socialmedia__link socialmedia__link--email"
	title="<?php _e( 'Share by email', THEMEDOMAIN ); ?>">
		<span class="screen-reader-text"><?php _e( 'Share by email', THEMEDOMAIN ); ?></span>
		<span class="icon-email"></span>
	</a>

	<a href="#" onclick="window.print()" class="socialmedia__link socialmedia__link--print" title="<?php _e( 'Print', THEMEDOMAIN ); ?>">
		<span class="screen-reader-text"><?php _e( 'Print', THEMEDOMAIN ); ?></span>
		<span class="icon-print"></span>
	</a>

</div>

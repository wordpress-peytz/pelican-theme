<?php
use Peytz\Picture\Facades\Picture;
use Peytz\Picture\Html\Picture\Attribute\ImageAttributes;
use Peytz\Picture\Html\Picture\Attribute\PictureAttributes;
?>

<?php if ( has_post_thumbnail() ) : ?>
	<div class="post-featured">

		<div class="post-featured__image-wrap">
			<?php
			Picture::render(
				(int) get_post_thumbnail_id(),
				'peli-post-featured',
				new PictureAttributes(
					id: 'featured-image',
					class: 'peytz-picture featured-image'
				),
				new ImageAttributes(
					width: 1160,
					height: 653,
					loading: 'eager',
					decoding: 'auto',
					fetchpriority: 'high',
					rel: 'preload',
					title: ''
				)
			);
			?>
		</div>

	</div>
<?php endif; ?>

<?php do_action( THEMEDOMAIN . '_after_post_featured' ); ?>

<?php $image_id = apply_filters( THEMEDOMAIN . '_archive_hero_image_id', 0 ); ?>

<?php if ( $image_id ) : ?>
	<div class="">
		<div class="">
			<?php
			echo wp_get_attachment_image(
				$image_id,
				'peli-hero-xl',
				false,
				[
					'data-picture'             => 'hero-breaker',
					'data-picture-class'       => 'hero__picture',
					'data-picture-image-class' => 'hero__image',
					'loading'                  => 'eager',
					'fetchpriority'            => 'high',
					'decoding'                 => 'auto',
					'rel'                      => 'preload',
				]
			);
			?>
		</div>
	</div>
<?php endif; ?>

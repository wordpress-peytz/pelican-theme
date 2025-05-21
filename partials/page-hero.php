<?php
use Peytz\Picture\Facades\Picture;
use Peytz\Picture\Html\Picture\Attribute\ImageAttributes;
use Peytz\Picture\Html\Picture\Attribute\PictureAttributes;

$post_id           = get_the_ID();
$hide_hero         = apply_filters( THEMEDOMAIN . '_hero_hide_hero', get_post_meta( $post_id, '_' . THEMEDOMAIN . '_hero_settings_hide_hero', true ) );
$bottom_spacing    = apply_filters( THEMEDOMAIN . '_hero_bottom_spacing', get_post_meta( $post_id, '_' . THEMEDOMAIN . '_hero_settings_bottom_spacing', true ) );
$remove_hero_image = apply_filters( THEMEDOMAIN . '_hero_remove_hero_image', get_post_meta( $post_id, '_' . THEMEDOMAIN . '_hero_settings_remove_hero_image', true ) );
$image_dimming     = apply_filters( THEMEDOMAIN . '_hero_image_dimming', get_post_meta( $post_id, '_' . THEMEDOMAIN . '_hero_settings_image_dimming', true ) );
$formatted_title   = apply_filters( THEMEDOMAIN . '_hero_formatted_title', get_post_meta( $post_id, '_' . THEMEDOMAIN . '_hero_settings_formatted_title', true ) );
$subtitle          = apply_filters( THEMEDOMAIN . '_hero_subtitle', get_post_meta( $post_id, '_' . THEMEDOMAIN . '_hero_settings_subtitle', true ) );
$link              = apply_filters( THEMEDOMAIN . '_hero_link', get_post_meta( $post_id, '_' . THEMEDOMAIN . '_hero_settings_link', true ) );
$link_text         = apply_filters( THEMEDOMAIN . '_hero_link_text', get_post_meta( $post_id, '_' . THEMEDOMAIN . '_hero_settings_link_text', true ) );
$hero_class        = apply_filters( THEMEDOMAIN . '_hero_class', '' );
$hero_text_class   = apply_filters( THEMEDOMAIN . '_hero_text_wrap_class', '' );

if ( ! $remove_hero_image && has_post_thumbnail() ) {
	$hero_class      .= ' hero--with-image';
	$hero_text_class .= ' hero__text-wrap--with-image';
}

if ( ! $remove_hero_image && has_post_thumbnail() && $image_dimming ) {
	$hero_class .= ' hero--image-dimming-' . $image_dimming;
}

if ( ! $bottom_spacing ) {
	$hero_class .= ' hero--has-bottom-spacing';
}

/*
$css = [];

$handle = 'hero';

// Example START
$css = [
	'.hero .hero__text-wrap' => [
		'background-color' => 'red',
	],
];
// Example END

\Pelican\Theme\TemplateFunctions\Css::add_inline_css( $css, $handle );
*/

?>

<?php if ( ! $hide_hero ) : ?>
<header class="hero<?php echo $hero_class; ?>">
	<div class="hero__text-wrap <?php echo $hero_text_class; ?>">
		<div class="hero__text-wrap-inner">
			<h1 class="hero__title"><?php echo $formatted_title ? '<span class="hero__formatted-title">' . $formatted_title . '</span>' : get_the_title(); ?></h1>

			<?php if ( $subtitle ) : ?>
			<p class="hero__subtitle"><?php echo $subtitle; ?></p>
			<?php endif; ?>

			<?php if ( $link && $link_text ) : ?>
			<div class="hero__link-wrapper">
				<a class="hero__link btn" href="<?php echo $link; ?>">
					<?php echo $link_text; ?>
				</a>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( has_post_thumbnail() && ! $remove_hero_image ) : ?>
	<div class="hero__image-wrap">
		<?php
			Picture::render(
				attachment: get_post_thumbnail_id(),
				schema: 'peli-hero',
				picture_attributes: new PictureAttributes(
					class: 'hero__picture'
				),
				image_attributes: new ImageAttributes(
					width: 1920,
					height: 700,
					class: 'hero__image',
					loading: 'eager',
					decoding: 'auto',
					fetchpriority: 'high',
					rel: 'preload',
					title: ''
				)
			);
		?>
	</div>
	<?php endif; ?>

</header>
<?php endif; ?>

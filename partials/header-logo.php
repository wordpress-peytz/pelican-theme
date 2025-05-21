<div class="<?php echo apply_filters( THEMEDOMAIN . '_logo_class', 'logo' ); ?>">

	<?php
	$logo_path   = get_stylesheet_directory() . '/assets/dist/img/logo.svg';
	$logo_exists = file_exists( $logo_path );
	$logo_uri    = get_stylesheet_directory_uri() . '/assets/dist/img/logo.svg';
	$logo_class  = 'logo__link ' . ( $logo_exists ? 'logo__image' : 'logo__text' );
	$logo_width  = 296;
	$logo_height = 75;
	?>

	<a
	class="<?php echo $logo_class; ?>"
	href="<?php echo home_url(); ?>"
	rel="home"
	title="<?php _e( 'Home', THEMEDOMAIN ); ?>">
		<?php
		if ( $logo_exists ) {
			?>
			<img
			class="logo__image"
			src="<?php echo $logo_uri; ?>"
			alt="<?php bloginfo( 'name' ); ?>"
			width="<?php echo $logo_width; ?>"
			height="<?php echo $logo_height; ?>"
			/>
			<?php
		} else {
			// This should never happen, but just in case
			?>
			<span><?php bloginfo( 'name' ); ?></span>
			<?php
		}
		?>
	</a>

</div> <!-- logo -->

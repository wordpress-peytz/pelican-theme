<?php
namespace Pelican\Theme\Markup;

/**
 * Handles loading custom fonts
 */
class Font {

	public function __construct() {
		add_action( 'wp_head', [ $this, 'custom_google_fonts' ], 10 );
	}

	/**
	 * Define inflix based on development environment (set in PCO Mu plugin).
	 */
	public function get_inflix(): string {
		// default to using minified files.
		$inflix = '.min';

		// if ( \PCo\MU\Plugin::is_local() ) {
			// default to using development (non-minified) files, if they exist and the environment is local.
			$inflix = ( file_exists( get_template_directory() . '/assets/dist/css/webfonts.css' ) ? '' : '.min' );
		// }

		return $inflix;
	}

	/**
	 * Loads custom webfonts in page head section
	 */
	public function custom_google_fonts(): void {
		// toggle inflix based on environment and file existence.
		$inflix    = $this->get_inflix();
		$fonts_url = get_template_directory_uri() . '/assets/dist/css/webfonts' . $inflix . '.css';

		?>

		<link
			rel="preload"
			as="style"
			href="<?php echo $fonts_url; ?>"
		/>

		<link
			rel="stylesheet"
			href="<?php echo $fonts_url; ?>"
			media="print" onload="this.media='all'"
		/>

		<noscript>
			<link
				rel="stylesheet"
				href="<?php echo $fonts_url; ?>"
			/>
		</noscript>

		<?php
	}

}

new Font();

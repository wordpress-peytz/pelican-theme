<?php
/**
 * Enqueue scripts and styles for the theme
 */
namespace Pelican\Theme\Core;

use Pelican\Theme\Helpers\FileHelpers;

class EnqueueAssets {

	public function __construct() {
		add_action( 'wp_head', [ $this, 'load_fonts' ], 10 );
		add_action('wp_enqueue_scripts', [ $this, 'enqueue_child_style_and_scripts' ] );
		add_action('admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
	}

	public function load_fonts() {
		// toggle inflix based on environment and file existence.
		$inflix    = FileHelpers::get_inflix();
		$fonts_url = get_stylesheet_directory_uri() . '/assets/dist/css/webfonts' . $inflix . '.css';

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

	/**
	 * Enqueue frontend scripts and styles
	 */
	public function enqueue_child_style_and_scripts(): void {
		// Define version numbers (previously retrieved from theme info)
		$css_version = '1.0.0';
		$js_version  = '1.0.0';

		// Get inflix for file extensions
		$inflix = FileHelpers::get_inflix();

		// Enqueue styles

		// Normalize CSS from CDN
		wp_enqueue_style(
			'normalize',
			'https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css',
			[],
			'8.0.1'
		);

		// Frontend styles
		wp_enqueue_style(
			'pelican-css-base',
			get_stylesheet_directory_uri() . '/assets/dist/css/base' . $inflix . '.css',
			[ 'normalize', 'wp-block-library' ],
			$css_version
		);

		// Enqueue frontend scripts

		// Get extracted dependencies for base script
		$base_js_extracted_deps = $this->get_extracted_deps('js/base' );
		$base_js_deps           = array_merge(
			$base_js_extracted_deps,
			[
			// Add any custom extra dependencies here if needed
			]
		);

		// Frontend scripts
		wp_enqueue_script(
			'pelican-js-base',
			get_stylesheet_directory_uri() . '/assets/dist/js/base' . $inflix . '.js',
			$base_js_deps,
			$js_version,
			true // Load in footer
		);

		// Enqueue comment-reply script
		if ( is_singular() && comments_open() && get_option('thread_comments' ) == 1 ) {
			wp_enqueue_script('comment-reply' );
		}
	}

	/**
	 * Enqueue admin scripts and styles
	 *
	 * @return void
	 */
	public function enqueue_admin_scripts(): void {
		// Define version numbers
		$css_version = '1.0.0';
		$js_version  = '1.0.0';

		// Get inflix for file extensions
		$inflix = FileHelpers::get_inflix();

		// Admin styles
		wp_enqueue_style(
			'pelican-css-base-admin',
			get_stylesheet_directory_uri() . '/assets/dist/css/base-admin' . $inflix . '.css',
			[],
			$css_version
		);

		// Get extracted dependencies for admin script
		$base_admin_js_extracted_deps = $this->get_extracted_deps('js/base-admin' );
		$base_admin_js_deps           = array_merge(
			$base_admin_js_extracted_deps,
			[
			// Add any custom extra dependencies here if needed
			]
		);

		// Admin scripts
		wp_enqueue_script(
			'pelican-js-base-admin',
			get_stylesheet_directory_uri() . '/assets/dist/js/base-admin' . $inflix . '.js',
			$base_admin_js_deps,
			$js_version,
			true // Load in footer
		);
	}

	/**
	 * Get extracted dependencies from webpack
	 *
	 * @param string $file_path The file basename (relative to the `dist` directory)
	 * @return array Returns array of extracted dependencies
	 */
	private function get_extracted_deps( string $file_path = 'js/base' ): array {
		$script_inflix   = FileHelpers::get_inflix();
		$asset_file_path = get_theme_file_path() . '/assets/dist/' . $file_path . $script_inflix . '.asset.php';

		if ( file_exists($asset_file_path ) ) {
			$extracted_deps_file = include $asset_file_path;
			if ( is_array($extracted_deps_file ) && isset($extracted_deps_file['dependencies'] ) ) {
				return $extracted_deps_file['dependencies'];
			}
		}

		return [];
	}

}

new EnqueueAssets();

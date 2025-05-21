<?php

namespace Pelican\Theme\Core;

/**
 * Styles for the administration login screens
 */
class PrettifyLoginPage {

	public function __construct() {
		add_action( 'login_enqueue_scripts', [ $this, 'login_logo' ] );
		add_action( 'login_enqueue_scripts', [ $this, 'login_enqueue' ] );
	}

	// Sets the logo shown on login page
	public function login_logo(): void {
		?>
		<style type="text/css">
		body.login {
			background-image: url('<?php echo get_stylesheet_directory_uri() . '/assets/dist/img/login-background.jpg'; ?>');
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
		}

		#login #login_error,
		#login .message,
		#login .success {
			margin-bottom: 0;
			color: #fff;
			background-color: #72aee6bf;
			border: none;
		}

		#login #login_error a,
		#login .message a,
		#login .success a {
			color: #fff;
		}

		div#login {
			padding-top: 15%;
		}
		#login h1 {
			background: #ffffffbf;
			padding: 20px;
			border-bottom: 2px solid #2271b1;
			border-top-right-radius: 5px;
			border-top-left-radius: 5px;
		}
		#login h1 a {
			content: url('<?php echo get_stylesheet_directory_uri() . '/assets/dist/img/logo.svg'; ?>');
			background-image: none;
			width: auto;
			height: auto;
			margin: 0 auto;
			max-width: 100%;
		}

		#loginform {
			border: none;
			margin-top: 0;
			background: #ffffffbf;
			border-bottom-right-radius: 5px;
			border-bottom-left-radius: 5px;
		}

		@media screen and (min-width: 721px) {
			#language-switcher {
				position: absolute;
				right: 20px;
				top: 20px;
			}
		}
		</style>
		<?php
	}

	// Add styles for the login screen
	public function login_enqueue(): void {
		// Determine if we should use minified version
		$suffix = ( defined('SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		// Get theme version for cache busting
		$theme   = wp_get_theme();
		$version = $theme->get('Version' );

		// Register and enqueue the login CSS
		wp_register_style(
			'pelican-login-styles',
			get_template_directory_uri() . '/assets/dist/css/base-login' . $suffix . '.css',
			[],
			$version
		);

		wp_enqueue_style('pelican-login-styles' );

		// Add preload for the stylesheet
		add_filter(
			'style_loader_tag',
			function ( $tag, $handle ) {
				if ( $handle === 'pelican-login-styles' ) {
					return str_replace("rel='stylesheet'", "rel='preload' as='style' onload='this.onload=null;this.rel=\"stylesheet\"'", $tag );
				}
				return $tag;
			},
			10,
			2
		);
	}

}

new PrettifyLoginPage();

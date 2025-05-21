<?php

namespace Pelican\Theme\Markup;

/**
 * Function hooks for index
 */
class FunctionHooksBodyTop {

	public function __construct() {
		add_action( THEMEDOMAIN . '_body_top', [ __CLASS__, 'wp_body_open' ], 50 );
		add_action( THEMEDOMAIN . '_body_top', [ __CLASS__, 'body_overlay' ], 50 );
		add_action( THEMEDOMAIN . '_body_top', [ __CLASS__, 'skip_link' ], 50 );
	}

	/**
	 * Fires wp_body_open action
	 */
	public static function wp_body_open(): void {
		?>

		<?php wp_body_open(); ?>

		<?php
	}

	/**
	 * Function to get body overlay - Used as background when opening search or burger menu
	 */
	public static function body_overlay(): void {
		?>

		<div class="body-overlay"></div>

		<?php
	}

	/**
	 * Function to get skip-to-content button
	 */
	public static function skip_link(): void {
		?>

		<a class="skip-link" href="#content"><?php _e( 'Skip to content', THEMEDOMAIN ); ?></a>

		<?php
	}

}

new FunctionHooksBodyTop();
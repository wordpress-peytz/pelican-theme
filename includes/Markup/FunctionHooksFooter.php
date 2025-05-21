<?php

namespace Pelican\Theme\Markup;

/**
 * Function hooks for footer
 */
class FunctionHooksFooter {

	public function __construct() {

		add_action( THEMEDOMAIN . '_site_footer', [ __CLASS__, 'footer_markup' ], 50 );
		add_action( THEMEDOMAIN . '_footer_content', [ __CLASS__, 'footer_markup_inner_open' ], 30 );
		add_action( THEMEDOMAIN . '_footer_content', [ __CLASS__, 'footer_markup_inner_close' ], 70 );
	}

	/**
	 * Function to get site footer wrapper
	 */
	public static function footer_markup(): void {
		?>

		<footer id="footer" class="site-footer" role="contentinfo">

			<?php do_action( THEMEDOMAIN . '_footer_content' ); ?>

		</footer>

		<?php
	}

	/**
	 * Function to get site footer inner opening markup
	 */
	public static function footer_markup_inner_open(): void {
		?>

		<div class="site-footer__inner">

			<?php dynamic_sidebar( 'footer-widget-area' ); ?>

		<?php
	}

	/**
	 * Function to get site footer inner closing markup
	 */
	public static function footer_markup_inner_close(): void {
		?>

		</div>

		<?php
	}

}

new FunctionHooksFooter();

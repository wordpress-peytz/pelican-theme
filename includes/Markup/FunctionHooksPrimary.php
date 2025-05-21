<?php

namespace Pelican\Theme\Markup;

/**
 * Function hooks for index
 */
class FunctionHooksPrimary {

	public function __construct() {

		add_action( THEMEDOMAIN . '_primary', [ __CLASS__, 'content_wrapper_markup_open' ], 30 );
		add_action( THEMEDOMAIN . '_primary', [ __CLASS__, 'loop_markup' ], 50 );
		add_action( THEMEDOMAIN . '_primary', [ __CLASS__, 'content_wrapper_markup_close' ], 70 );
		add_action( THEMEDOMAIN . '_primary_content', [ __CLASS__, 'main_loop_markup_inner_open' ], 30 );
		add_action( THEMEDOMAIN . '_primary_content', [ __CLASS__, 'main_loop_markup_inner_close' ], 70 );

		// Main loop
		add_action( THEMEDOMAIN . '_primary_content', [ __CLASS__, 'main_loop' ], 50 );
	}

	/**
	 * Function to get site index wrapper
	 */
	public static function content_wrapper_markup_open(): void {
		?>

		<div id="content" class="<?php echo apply_filters( THEMEDOMAIN . '_content_class', 'site-content', 10 ); ?>" aria-label="<?php echo __( 'Site content', THEMEDOMAIN ); ?>">

			<?php do_action( THEMEDOMAIN . '_primary_content_top' ); ?>

		<?php
	}

	/**
	 * Function to get site index wrapper
	 */
	public static function loop_markup(): void {
		?>

		<?php do_action( THEMEDOMAIN . '_primary_content' ); ?>

		<?php
	}

	/**
	 * Function to get site index wrapper
	 */
	public static function content_wrapper_markup_close(): void {
		?>

			<?php do_action( THEMEDOMAIN . '_primary_content_bottom' ); ?>

		</div>

		<?php
	}

	/**
	 * Function to get site loop inner opening markup
	 */
	public static function main_loop_markup_inner_open(): void {
		?>

		<div id="primary" class="primary" aria-label="<?php echo __( 'Primary content', THEMEDOMAIN ); ?>">

			<main id="main" class="site-main" role="main">

		<?php
	}

	/**
	 * Function to get site loop inner closing markup
	 */
	public static function main_loop_markup_inner_close(): void {
		?>

			</main>

			<?php apply_filters( THEMEDOMAIN . '_show_sidebar', true, get_the_ID() ) ? get_sidebar() : false; ?>

		</div>

		<?php
	}

	/**
	 * Function to get site index inner opening markup
	 */
	public static function main_loop(): void {
		?>

		<?php get_template_part( 'template-parts/loop' ); ?>

		<?php
	}

}

new FunctionHooksPrimary();
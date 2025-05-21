<?php

namespace Pelican\Theme\Markup;

/**
 * Function hooks for header
 */
class FunctionHooksHeader {

	public function __construct() {

		add_action( THEMEDOMAIN . '_header', [ __CLASS__, 'header_markup' ], 50 );
		add_action( THEMEDOMAIN . '_header_content', [ __CLASS__, 'header_markup_inner_open' ], 30 );
		add_action( THEMEDOMAIN . '_header_content', [ __CLASS__, 'header_markup_inner_close' ], 70 );

		// Template parts
		add_action( THEMEDOMAIN . '_header_content', [ __CLASS__, 'header_template_logo' ], 50 );
		add_action( THEMEDOMAIN . '_header_content', [ __CLASS__, 'header_template_navigation' ], 50 );
		add_action( THEMEDOMAIN . '_header_content', [ __CLASS__, 'header_template_navigation_mobile' ], 70 );
		add_action( THEMEDOMAIN . '_header_content', [ __CLASS__, 'header_template_searchform' ], 70 );
	}

	/**
	 * Function to get header wrapper
	 */
	public static function header_markup(): void {
		?>

		<header id="header" class="<?php echo apply_filters( THEMEDOMAIN . '_header_class', 'site-header' ); ?>">

			<?php do_action( THEMEDOMAIN . '_header_content' ); ?>

		</header>

		<?php
	}

	/**
	 * Function to get header inner opening markup
	 */
	public static function header_markup_inner_open(): void {
		?>

		<div class="main-header-bar-wrap">

			<div class="main-header-bar">

		<?php
	}

	/**
	 * Function to get header inner closing markup
	 */
	public static function header_markup_inner_close(): void {
		?>

			</div>

		</div>

		<?php
	}

	/**
	 * Function to get logo partial
	 */
	public static function header_template_logo(): void {
		?>

		<?php get_template_part( 'partials/header', 'logo' ); ?>

		<?php
	}

	/**
	 * Function to get navigation partial
	 */
	public static function header_template_navigation(): void {
		?>

		<?php get_template_part( 'partials/navigation', 'main' ); ?>

		<?php
	}

	/**
	 * Function to get mobile navigation partial
	 */
	public static function header_template_navigation_mobile(): void {
		?>

		<?php get_template_part( 'partials/navigation', 'mobile' ); ?>

		<?php
	}

	/**
	 * Function to get searchform partial
	 */
	public static function header_template_searchform(): void {
		?>

		<?php get_template_part( 'partials/searchform', 'header' ); ?>

		<?php
	}

}

new FunctionHooksHeader();
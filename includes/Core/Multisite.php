<?php

namespace Pelican\Theme\Core;

/**
 * Multisite specific functions and hooks.
 * Mainly used to control global elements.
 */
class Multisite {

	// Action hooks to switch blog
	public $switch_blog = [
		'before_main_nav',
		'before_top_nav',
		'before_footer',
	];

	// Action hooks to restore blog
	public $restore_blog = [
		'after_main_nav',
		'after_top_nav',
		'after_footer',
	];

	public function __construct() {

		if ( ! is_multisite() ) {
			return;
		}

		$this->run_hooks( $this->switch_blog, 'switch_to_main_site', 10 );
		$this->run_hooks( $this->restore_blog, 'restore_blog', 10 );

		add_action( 'updated_option', [ $this, 'update_transient' ] );
		add_filter( 'body_class', [ $this, 'multisite_body_classes' ] );
	}

	// Add blog name and id as classes for body
	public function multisite_body_classes( array $classes ): array {
		$id        = get_current_blog_id();
		$slug      = strtolower( str_replace( ' ', '-', sanitize_title( get_bloginfo( 'name' ) ) ) );
		$classes[] = $slug;
		$classes[] = 'site-id-' . $id;
		return $classes;
	}

	// Add callback to action for hooks
	// @param string $callback name of callback method
	public function run_hooks( array $hooks, string $callback ): void {
		foreach ( $hooks as $hook ) {
			add_action( self::get_hook( $hook ), [ $this, $callback ] );
		}
	}

	// Get hook prefixed by THEMEDOMAIN
	public static function get_hook( string $hook ): string {
		return THEMEDOMAIN . '-' . $hook;
	}

	// Switch to current_site
	public function switch_to_main_site(): void {
		global $current_site;
		\switch_to_blog( $current_site->blog_id );
	}

	// Restore bloc
	public function restore_blog(): void {
		\restore_current_blog();
	}

	// ... for sidebars
	public static function update_transient(): void {
		$sidebars = [ 'footer-1', 'footer-2' ];

		foreach ( $sidebars as $sidebar ) {
			self::delete_transient( $sidebar );
			self::set_widget_transient( $sidebar );
		}
	}

	public static function set_widget_transient( int|string $id ): string {
		$transient = get_site_transient( $id );

		if ( $transient ) {
			return '';
		}

		ob_start();

		dynamic_sidebar( $id );

		$sidebar = ob_get_clean();

		set_site_transient( $id, $sidebar, 7 * 24 * HOUR_IN_SECONDS );

		return $sidebar;
	}

	// Deletes transient
	public static function delete_transient( int|string $option ): void {
		delete_site_transient( $option );
	}

}

new Multisite();
